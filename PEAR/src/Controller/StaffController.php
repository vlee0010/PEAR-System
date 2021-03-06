<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Role;
use Cake\Mailer\Email;
use Cake\I18n\Number;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\BreadcrumbsHelper;
use Cake\Mailer\TransportFactory;
use Cake\Event\Event;
use ArrayObject;
use Cake\Utility\Security;


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
        $this->loadModel('peer_reviews_teams');
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
//        15 FIT5050
//        debug($id);
 //        bug,tutor class
        $unit_class_list = $this->units_classes->find()->where(['unit_id' => $id]);
        $class_id_list = [];
        $peer_review = $this->peer_reviews->find()->where(['unit_id' => $id, 'status' => 0])->first();

        if($peer_review) {
            $peer_id = $peer_review->id;

            $this->set(compact('peer_id'));

        }else{
            $peer_id = 0;
            $this->set(compact('peer_id'));
        }
        foreach ($unit_class_list as $unit_class) {
            array_push($class_id_list, $unit_class->class_id);
        }
        $class_list = [];
        foreach ($class_id_list as $class_id) {
            if ($this->Classes->find()->where(['id' => $class_id, 'tutor_id' => $this->Auth->user('id')])->first()) {
                array_push($class_list, $this->Classes->find()->where(['id' => $class_id, 'tutor_id' => $this->Auth->user('id')])->first());
            }

        }
        $tutor_id = $this->Auth->user('id');

        $this->set('unit_id', $id);
        $this->set(compact('class_list'));
    }

    public function displaystudent($id = null, $peer_id = null)
    {

        $students_classes_query = $this->students_classes->find()->where(['class_id' => $id]);

        $studentClassList = $students_classes_query->select([
            'id' => 'u.id',
            'firstname' => 'u.firstname',
            'lastname' => 'u.lastname',
        ])->join([
            'c' => [
                'table' => 'classes',
                'conditions' => [
                    'students_classes.class_id = c.id',
                ]
            ],
            'u' => [
                'table' => 'users',
                'conditions' => [
                    'students_classes.user_id = u.id',
                ]
            ]
        ])->distinct();

        $peer_review_user_query = $this->peer_reviews_users->find()->where(['peer_review_id' => $peer_id]);

        $peer_review = $this->peer_reviews->find()->where(['id' => $peer_id])->first();

        $peer_query = $this->units_classes->find()->where(['class_id' => $id]);
        $unit_activity = $peer_query->select([
            'unit_id' => 'u.id',
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

        $queryTerms = $this->getRequest()->getQuery('query');
        if (!empty($queryTerms)) {
            $student_list = [];
            $queryTermsWithWildCard = '%' . $queryTerms . '%';
            foreach ($studentClassList as $user_id) {
                array_push($student_list, $this->Users->find()->where([
                    'id' => $user_id->id,
                    'OR' => [
                        'firstname LIKE' => $queryTermsWithWildCard,
                        'lastname LIKE' => $queryTermsWithWildCard,
                        'email LIKE' => $queryTermsWithWildCard,
                    ]
                ])->first());
            }
            $student_list = array_filter($student_list);
        } else {
            $student_list = [];
            foreach ($studentClassList as $user_id) {
                array_push($student_list, $this->Users->find()->where(['id' => $user_id->id])->first());
            }
        }


        $this->set('unit_activity', $unit_activity);
        $this->set('peerReviewUser', $peer_review_user_query);
        $this->set('studentClassList', $studentClassList);
        $this->set('query', $queryTerms);
        $this->set(compact('student_list', 'peer_review', "peer_id"));

    }

    public function displayResults($user_id = null, $peer_review_id = null)
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
//        ))->where(['Responses.user_id'=>$user_id,'Responses.peer_review_id'=>$peer_review_id]);
        $response_list = $this->Responses->find()->contain([
            'Questions',
            'Users'
        ])->where(['user_id' => $user_id, 'peer_review_id' => $peer_review_id]);
//        foreach ($response_list as $response){
//            debug($response);
//        }
        $this->set(compact('response_list'));
    }

    public function resetResponse($user_id, $peer_id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $response = $this->Responses->find('all')->where(['user_id' => $user_id, 'peer_review_id' => $peer_id]);
        $this->Responses->deleteAll(['user_id' => $user_id, 'peer_review_id' => $peer_id]);

        $this->set('response', $response);

        $peerReviewsUsersTable = TableRegistry::getTableLocator()->get('peer_reviews_users');
        $peerReviewsUsers = $peerReviewsUsersTable->get([$user_id, $peer_id]);
        $peerReviewsUsers->status = 0;
        $peerReviewsUsersTable->save($peerReviewsUsers);

        $this->set('peerReviewsUsers', $peerReviewsUsers);
        $this->Flash->success(__('The response has been reset.'));
        $this->redirect($this->referer());
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
            'user_id' => 'us.id',
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
            'user_id' => 'us.id',
            'firstname' => 'us.firstname',
            'lastname' => 'us.lastname'

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
            ]
        ])->distinct();

        $team_query = $this->peer_reviews_teams->find()->where(['peer_review_id' => $peer_id]);
        $team_list = $team_query->select([
            'team' => 't.name',
            'user_id' => 'tu.user_id'
        ])->join([
            't' => [
                'table' => 'teams',
                'conditions' => [
                    'peer_reviews_teams.team_id = t.id_ ',
                ]
            ],
            'tu' => [
                'table' => 'teams_users',
                'conditions' => [
                    'tu.team_id = t.id_ '
                ]
            ]
        ])->distinct();

        $response_query_4 = $this->Responses->find()->where(['peer_review_id' => $peer_id]);
        $student_comment = $response_query_4->select([
            'user_id' => 'us.id',
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
            foreach ($team_list as $item):
                if ($item->user_id == $student->user_id):
                    $team = $item->team;
                endif;
            endforeach;
            array_push($ar, $student_name, $team);
            foreach ($student_result_array as $item):
                if ($item->user_id == $student->user_id):
                    $float = (float)$item->average_score;
                    $result = Number::format($float, ['precision' => 1]);
                    array_push($ar, $result);
                endif;
            endforeach;
            foreach ($student_comment_list as $item):
                if ($item->ratee_id == $student->user_id):
                    $comment .= "<b>" . $item->student_firstname . " " . $item->student_lastname . ":</b>. " . $item->comment;
                    $comment .= "<br/>";
                endif;
            endforeach;
            array_push($ar, $comment);
            array_push($data, $ar);
            $ar = [];
        endforeach;

        foreach ($unit_activity as $unit):
            $file_name = $unit->unitcode . ' ' . $unit->year . ' Semester ' . $unit->semester . ' ' . $unit->activity . ' ' . 'Result.csv';
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
            'unit_id' => 'Units.id',
            'unitname' => 'Units.title',
            'unitcode' => 'Units.code',
            'peer_id' => 'peer_reviews.id',
            'activity' => 'peer_reviews.title',
        ])->innerJoinWith('Units');


        $questions_desc = $response_query->select([
            'question_id' => "Questions.id",
            'question' => "Questions.description",

        ])->innerJoinWith('Questions')
            ->where([
                'Responses.is_text_number' => 0
            ])
            ->distinct();

        $count_num_question = $questions_desc->count();

        $response_query_2 = $this->Responses->find()->where(['peer_review_id' => $peer_id]);
        $student_result = $response_query_2->select([
            'user_id' => 'us.id',
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

//
//        $student_result_sum = $student_result->select([
//            'user_id' => 'us.id',
//            'count' => $student_result->func()->count('average_score'),
//            'sum_score' => $student_result->func()->sum('average_score'),
//            'total_score'
//        ])->group(['us.id']);

        $student_result_array = [];
        foreach ($student_result as $item):
            array_push($student_result_array, $item);
        endforeach;

        $response_query_3 = $this->peer_reviews_users->find()->where(['peer_review_id' => $peer_id]);
        $student_list = $response_query_3->select([
            'user_id' => 'us.id',
            'firstname' => 'us.firstname',
            'lastname' => 'us.lastname',
            'status' => 'peer_reviews_users.status'
        ])->join([
            'us' => [
                'table' => 'users',
                'conditions' => [
                    'us.id = peer_reviews_users.user_id',
                ]
            ]
        ])->distinct();
        $student_list->toArray();

        $team_query = $this->peer_reviews_teams->find()->where(['peer_review_id' => $peer_id]);
        $team_list = $team_query->select([
            'team_id' => 't.id_',
            'team' => 't.name',
            'user_id' => 'tu.user_id'
        ])->join([
            't' => [
                'table' => 'teams',
                'conditions' => [
                    'peer_reviews_teams.team_id = t.id_ ',
                ]
            ],
            'tu' => [
                'table' => 'teams_users',
                'conditions' => [
                    'tu.team_id = t.id_ '
                ]
            ]
        ])->distinct();

        $team_list->toArray();
        $ar = [];
        $studentList = [];
        foreach ($student_list as $student):
            $user_id = $student->user_id;
            $student_name = $student->firstname . " " . $student->lastname;
            $status = $student->status;
            foreach ($team_list as $item):
                if ($item->user_id == $student->user_id):
                    $team_id = $item->team_id;
                    $team = $item->team;
                    array_push($ar,$user_id, $student_name,$team_id,$team,$status);
                endif;
            endforeach;
            array_push($studentList, $ar);
            $ar =[];
        endforeach;

        $teamList = [];
        foreach ($studentList as $key => $item) {
            $teamList[$item['2']][$key] = $item;
        }
        ksort($teamList, SORT_NUMERIC);

        $this->set('studentList',$studentList);
        $this->set('teamList',$teamList);

        $response_query_4 = $this->Responses->find()->where(['peer_review_id' => $peer_id]);
        $student_comment = $response_query_4->select([
            'user_id' => 'us.id',
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


        $this->set('count', $count_num_question);
        $this->set('unit_activity', $unit_activity);
        $this->set('questions_desc', $questions_desc);
        $this->set('student_result_array', $student_result_array);
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

    public function beforeFilter($event)
    {
        parent::beforeFilter($event);
        $user = $this->Auth->user();

        //If user's role is 1(students), redirect to students page;
        if ($user['role'] == 1) {

            $this->redirect(['controller' => 'users', 'action' => 'studentdash']);
        }
        if ($user['role'] == 3) {

            $this->redirect(['controller' => 'admins', 'action' => 'index']);
        }
    }
}
