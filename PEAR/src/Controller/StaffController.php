<?php

namespace App\Controller;

use App\Model\Entity\Role;
use Cake\Mailer\Email;
use Cake\I18n\Number;
use Cake\Mailer\TransportFactory;

class StaffController extends AppController
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadModel('Units');
        $this->loadModel('peer_reviews');
        $this->loadModel('Users');
        $this->loadModel('units_tutors');
        $this->loadModel('units_classes');
        $this->loadModel('students_classes');
        $this->loadModel('units_users');
        $this->loadModel('teams_users');
        $this->loadModel('teams');
        $this->loadModel('Classes');
        $this->loadModel('peer_reviews_users');
        $this->loadModel('Responses');
        $this->loadModel('Questions');
        $this->viewBuilder()->setLayout('staff');
    }

    public function isAuthorized($user)
    {
        // If you are a user, you can access this dashboard.
        return Role::isStaff($user['role']);
    }

    public function index()
    {

        $tutor_id = $this->Auth->user('id');
        $unit_id_list = $this->units_tutors->find('list', array('field', array('unit_id')))->where(['tutor_id' => $tutor_id]);
        $unit_list = [];
        foreach ($unit_id_list as $unit_id) {
            array_push($unit_list, $this->Units->find()->where(['id' => $unit_id])->first());
        }

        $this->set(compact('unit_list'));

    }

    public function displayclass($id = null)
    {
        $unit_class_list = $this->units_classes->find()->where(['unit_id' => $id]);
        $class_id_list = [];
        $peer_review = $this->peer_reviews->find()->where(['unit_id' => $id, 'status' => 0])->first();
        $peer_id = $peer_review->id;
        foreach ($unit_class_list as $unit_class) {
            array_push($class_id_list, $unit_class->class_id);
        }
        $class_list = [];
        foreach ($class_id_list as $class_id) {
            array_push($class_list, $this->Classes->find()->where(['id' => $class_id])->first());

        }
        $tutor_id = $this->Auth->user('id');

        $this->set(compact('class_list', 'peer_id'));
    }

    public function displaystudent($id = null, $peer_id = null)
    {
        $student_id_list = $this->students_classes->find('list', array('field', array('student_id')))->where(['class_id' => $id]);
        $student_list = [];
        $peer_review_user_list = [];
        $student_id_list_new = [];
        foreach ($student_id_list as $student_id) {
            if ($this->peer_reviews_users->find()->where(['peer_review_id' => $peer_id, 'user_id' => $student_id, 'status' => 0])->first()) {
                array_push($peer_review_user_list, $this->peer_reviews_users->find()->where(['peer_review_id' => $peer_id, 'user_id' => $student_id, 'status' => 0])->first());
                array_push($student_id_list_new, $this->peer_reviews_users->find()->select('user_id')->where(['peer_review_id' => $peer_id, 'user_id' => $student_id, 'status' => 0])->first());
            }
        }
        foreach ($student_id_list_new as $student_id) {
            array_push($student_list, $this->Users->find()->where(['id' => $student_id->user_id])->first());
        }
        $peer_review = $this->peer_reviews->find()->where(['id' => $peer_id])->first();

        $peer_query = $this->units_classes->find()->where(['class_id' => $id]);
        $unit_activity = $peer_query->select([
            'unitname' => 'u.title',
            'unitcode' => 'u.code',
            'activity' => 'p.title',
            'datestart' => 'p.date_start',
            'dateend' => 'p.date_end',
            'peer_id' => 'p.id'
        ])->join([
            'u' => [
                'table' => 'units',
                'conditions' => [
                    'u.id = units_classes.unit_id',
                ]
            ],
            'p' => [
                'table' => 'peer_reviews',
                'conditions' => [
                    'p.unit_id = units_classes.unit_id',
                ]
            ]

        ]);

        $this->set('unit_activity', $unit_activity);

        $this->set(compact('student_list', 'peer_review', 'peer_review_user_list', "peer_id"));

    }

    public function displayResults($student_id = null, $peer_review_id = null)
    {
//        $response_list = $this->Responses->find('all',array(
//            'field'=>array('Response.*'),
//            'join'=>array(
//                array(
//                    'table'=>'Questions',
//                    'alias'=>'Question',
//                    'type'=>'INNER',
//                    'conditions'=>array('Responses.question_id'=>'Question.id')
//                ),
//            )
//        ))->where(['Responses.user_id'=>$student_id,'Responses.peer_review_id'=>$peer_review_id]);
        $response_list = $this->Responses->find()->contain([
            'Questions',
            'Users'
        ])->where(['user_id' => $student_id, 'peer_review_id' => $peer_review_id]);
//        foreach ($response_list as $response){
//            debug($response);
//        }
        $this->set(compact('response_list'));
    }

    public function export($peer_id = null)
    {


        $response_query = $this->Responses->find()->where(['peer_review_id' => $peer_id]);

        $peer_query = $this->peer_reviews->find()->where(['peer_reviews.id' => $peer_id]);
        $unit_activity = $peer_query->select([
            'unitname' => 'Units.title',
            'unitcode' => 'Units.code',
            'activity' => 'peer_reviews.title',
            'semester' => 'Units.semester',
            'year' => 'Units.year',
        ])->innerJoinWith('Units');


        $questions_desc = $response_query->select([
            'question_id' => "Questions.id",
            'question' => "Questions.description"
        ])->innerJoinWith('Questions')
            ->where([
                'Responses.is_text_number' => 0
            ])
            ->distinct();

        $response_query_2 = $this->Responses->find()->where(['peer_review_id' => $peer_id]);
        $student_result = $response_query_2->select([
            'student_id' => 'us.id',
            'question_id' => 'Responses.question_id',
            'average_score' => $response_query_2->func()->avg('Responses.rate_number'),
        ])->join([
            'us' => [
                'table' => 'users',
                'conditions' => [
                    'us.id = Responses.ratee_id',
                ]
            ],
            'q' => [
                'table' => 'questions',
                'conditions' => [
                    'q.id = Responses.question_id'
                ]
            ]
        ])
            ->where([
                'Responses.is_text_number' => 0
            ])
            ->group(['us.id', 'Responses.question_id']);

        $student_result_array = [];
        foreach ($student_result as $item):
            array_push($student_result_array, $item);
        endforeach;

        $response_query_3 = $this->Responses->find()->where(['Responses.peer_review_id' => $peer_id]);
        $student_list = $response_query_3->select([
            'student_id' => 'us.id',
            'firstname' => 'us.firstname',
            'lastname' => 'us.lastname',
            'team' => 't.name'
        ])->join([
            'us' => [
                'table' => 'users',
                'conditions' => [
                    'us.id = Responses.user_id',
                ]
            ],
            'p' => [
                'table' => 'peer_reviews',
                'conditions' => [
                    'Responses.peer_review_id' => $peer_id,
                    'p.id = Responses.peer_review_id',
                ]
            ],
            'pt' => [
                'table' => 'peer_reviews_teams',
                'conditions' => [
                    'pt.peer_review_id = p.id',
                ]
            ],
            't' => [
                'table' => 'teams',
                'conditions' => [
                    't.id_ = pt.team_id',
                ]
            ]
        ])
            ->distinct();

        $response_query_4 = $this->Responses->find()->where(['peer_review_id' => $peer_id]);
        $student_comment = $response_query_4->select([
            'student_id' => 'us.id',
            'student_firstname' => 'us.firstname',
            'student_lastname' => 'us.lastname',
            'question_id' => 'Responses.question_id',
            'comment' => 'Responses.rate_text',
            'ratee_id' => 'Responses.ratee_id',
            'ratee_firstname' => 'rus.firstname',
            'ratee_lastname' => 'rus.lastname',
        ])->join([
            'rus' => [
                'table' => 'users',
                'conditions' => [
                    'rus.id = Responses.ratee_id',
                ]
            ],
            'us' => [
                'table' => 'users',
                'conditions' => [
                    'us.id = Responses.user_id',
                ]
            ],
            'q' => [
                'table' => 'questions',
                'conditions' => [
                    'q.id = Responses.question_id'
                ]
            ]
        ])
            ->where([
                'Responses.is_text_number' => 1
            ]);

        $student_comment_list = [];
        foreach ($student_comment as $student_comment):
            array_push($student_comment_list, $student_comment);
        endforeach;

        $ar = [];
        $data = [];
        foreach ($student_list as $student):
            $comment = "";
            $student_name = $student->firstname . " " . $student->lastname;
            $team = $student->team;
            array_push($ar, $student_name, $team);
            foreach ($student_result_array as $item):
                if ($item->student_id == $student->student_id):
                    $float = (float)$item->average_score;
                    $result = Number::format($float, ['precision' => 1]);
                    array_push($ar, $result);
                endif;
            endforeach;
            foreach($student_comment_list as $item):
                if ($item->ratee_id == $student->student_id):
                    $comment .= "<b>".$item->student_firstname. " ".$item->student_lastname. ":</b>. ".$item->comment;
                    $comment .= "<br/>";
                endif;
            endforeach;
            array_push($ar, $comment);
            array_push($data, $ar);
            $ar = [];
        endforeach;

        foreach ($unit_activity as $unit):
                $file_name = $unit->unitcode . ' ' . $unit->year . ' Semester ' . $unit->semester .' '. $unit->activity .' '. 'Result.csv';
        endforeach;


        $_header = ['Student Name', 'Team'];
        foreach ($questions_desc as $questions_desc):
            array_push($_header, $questions_desc->question);
        endforeach;
        array_push($_header, 'Comment');

        $_serialize = 'data';

        $this->response = $this->response->withDownload($file_name);
        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('data', '_serialize', '_header'));
    }

    public function viewAllResults($peer_id = null)
    {
        $response_query = $this->Responses->find()->where(['peer_review_id' => $peer_id]);

        $peer_query = $this->peer_reviews->find()->where(['peer_reviews.id' => $peer_id]);
        $unit_activity = $peer_query->select([
            'unitname' => 'Units.title',
            'unitcode' => 'Units.code',
            'peer_id' => 'peer_reviews.id',
            'activity' => 'peer_reviews.title',
        ])->innerJoinWith('Units');


        $questions_desc = $response_query->select([
            'question_id' => "Questions.id",
            'question' => "Questions.description"
        ])->innerJoinWith('Questions')
            ->where([
                'Responses.is_text_number' => 0
            ])
            ->distinct();

        $response_query_2 = $this->Responses->find()->where(['peer_review_id' => $peer_id]);
        $student_result = $response_query_2->select([
            'student_id' => 'us.id',
            'question_id' => 'Responses.question_id',
            'average_score' => $response_query_2->func()->avg('Responses.rate_number'),
        ])->join([
            'us' => [
                'table' => 'users',
                'conditions' => [
                    'us.id = Responses.ratee_id',
                ]
            ],
            'q' => [
                'table' => 'questions',
                'conditions' => [
                    'q.id = Responses.question_id'
                ]
            ]
        ])
            ->where([
                'Responses.is_text_number' => 0
            ])
            ->group(['us.id', 'Responses.question_id']);

        $student_result_array = [];
        foreach ($student_result as $item):
            array_push($student_result_array, $item);
        endforeach;

        $response_query_3 = $this->Responses->find()->where(['Responses.peer_review_id' => $peer_id]);
        $student_list = $response_query_3->select([
            'student_id' => 'us.id',
            'firstname' => 'us.firstname',
            'lastname' => 'us.lastname',
            'team' => 't.name'
        ])->join([
            'us' => [
                'table' => 'users',
                'conditions' => [
                    'us.id = Responses.user_id',
                ]
            ],
            'p' => [
                'table' => 'peer_reviews',
                'conditions' => [
                    'Responses.peer_review_id' => $peer_id,
                    'p.id = Responses.peer_review_id',
                ]
            ],
            'pt' => [
                'table' => 'peer_reviews_teams',
                'conditions' => [
                    'pt.peer_review_id = p.id',
                ]
            ],
            't' => [
                'table' => 'teams',
                'conditions' => [
                    't.id_ = pt.team_id',
                ]
            ]
        ])
            ->distinct();

        $response_query_4 = $this->Responses->find()->where(['peer_review_id' => $peer_id]);
        $student_comment = $response_query_4->select([
            'student_id' => 'us.id',
            'student_firstname' => 'us.firstname',
            'student_lastname' => 'us.lastname',
            'question_id' => 'Responses.question_id',
            'comment' => 'Responses.rate_text',
            'ratee_id' => 'Responses.ratee_id',
            'ratee_firstname' => 'rus.firstname',
            'ratee_lastname' => 'rus.lastname',
        ])->join([
            'rus' => [
                'table' => 'users',
                'conditions' => [
                    'rus.id = Responses.ratee_id',
                ]
            ],
            'us' => [
                'table' => 'users',
                'conditions' => [
                    'us.id = Responses.user_id',
                ]
            ],
            'q' => [
                'table' => 'questions',
                'conditions' => [
                    'q.id = Responses.question_id'
                ]
            ]
        ])
            ->where([
                'Responses.is_text_number' => 1
            ]);

        $student_comment_list = [];
        foreach ($student_comment as $student_comment):
            array_push($student_comment_list, $student_comment);
        endforeach;


        $this->set('unit_activity', $unit_activity);
        $this->set('questions_desc', $questions_desc);
        $this->set('student_result_array', $student_result_array);
        $this->set('student_list', $student_list);
        $this->set('student_comment_list', $student_comment_list);
    }

    public function sendReminderEmail($peer_id = null)
    {

        $peer_review = $this->peer_reviews->find()->where(['peer_reviews.id' => $peer_id]);
        $peer_review_title = $peer_review->select([
            'title' => 'peer_reviews.title'
        ]);

        $unit_query = $peer_review->select([
            'code' => 'Units.code',
            'year' => 'Units.year',
            'semester' => 'Units.semester'
        ])->innerJoinWith('Units');

        $peer_review_user_query = $this->peer_reviews_users->find()->where(['peer_reviews_users.peer_review_id' => $peer_id, 'peer_reviews_users.status' => 0]);
        $student_list = $peer_review_user_query->select([
            'email' => 'us.email'
        ])->join([
            'us' => [
                'table' => 'users',
                'conditions' => [
                    'us.id = peer_reviews_users.user_id',
                ]
            ]
        ]);

//        $subject = $unit_title. ' Role via PEAR Monash';
        foreach ($peer_review_title as $peer_review_title):
            $activity_title = $peer_review_title->title;
        endforeach;

        foreach ($unit_query as $unit):
            $unit_code = $unit->code;
            $unit_year = $unit->year;
            $unit_semester = $unit->semester;
        endforeach;
        $student_email_list = [];
        foreach ($student_list as $student):
            array_push($student_email_list, $student->email);
        endforeach;


        $my_list = [];
        $myEmail = 'levanhai010198@gmail.com';
        $my2Email = 'rzan0002@student.monash.edu';
        array_push($my_list, $myEmail);
//        array_push($my_list,$my2Email);

        if (!empty($student_email_list)) {
            $from = $unit_code . " Role via Pear Monash";
            $subject = "PEAR Monash upcoming survey deadline";
            $header = "Activity will be closed soon";
            $message = "<h1>Activity will be closed soon</h1>";
            $message .= "The data for the following activity will be closed soon: <br><br>";
            $message .= "<i>Activity: " . $activity_title . " </i><br> ";
            $message .= "<i>Unit: " . $unit_code . " " . "$unit_year" . " S" . $unit_semester . "</i><br>";
            $message .= "<br>Please follow this link to complete: <a href='http://ie.infotech.monash.edu/team123/development/team123-app/PEAR'>PEAR Monash</a> ";
            if ($this->request->is('post')) {
                //            $this->Flash->set('Email Sent.',['element'=>'success']);
                $this->Flash->success(__('Email Sent'));
                $email = new Email('default');
                $email
                    ->transport('gmail')
                    ->from(['pearmonash@gmail.com' => $from])
                    ->subject($subject)
                    ->setHeaders([$header])
                    ->emailFormat('html')
                    ->bcc($student_email_list)
                    ->send($message);
                //            return $this->redirect(['action' => 'displaystudent',1,2]);
            } else {
                $this->Flash->set('Error sending email', ['element' => 'error']);
            }
            $this->set('title', $peer_review_title);
        }
    }
}
