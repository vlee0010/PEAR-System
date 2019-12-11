<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

use App\Model\Entity\Role;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\FlashHelper;
use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\Core\App;
use Cake\Controller\Exception\SecurityException;
use Cake\Utility\Security;
use Cake\Mailer\Email;


class AdminsController extends AppController
{


    public function initialize()
    {
        $this->loadModel('Questions');
        $unitTable = TableRegistry::getTableLocator()->get('units');
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadModel('Units');
        $this->loadModel('Users');
        $this->loadModel('Classes');
        $this->loadModel('UnitsClasses');
        $this->loadModel('peer_reviews_questions');
    }

    public function index()
    {

    }

    public function addQuestions()
    {
        $questionTable = TableRegistry::getTableLocator()->get('questions');
        if ($this->request->is('post')) {
            $questionDescription = $this->request->getData('question');
//            debug($questionDescription);
            $newQuestion = $questionTable->newEntity();
            $newQuestion->description = $questionDescription;
            if ($this->Questions->save($newQuestion)) {
                $this->Flash->success("New question ''" . $newQuestion->description . "'' has been added into the Question Bank Successfully!");
            };
        }
    }

    public function checkUnitExists()
    {

        $unitTable = TableRegistry::getTableLocator()->get('units');

        if ($this->request->is('post')) {
            $unitCode = $this->request->getData('unitCode');
            $title = $this->request->getData('title');
            $semester = $this->request->getData('semester');
            $year = $this->request->getData('year');
            $unitMatches = $unitTable->find()->where(['code' => $unitCode, 'semester' => $semester, 'year' => $year]);
            $matches = [];
//            debug($matches);
            foreach ($unitMatches as $unitMatch) {
//                debug($matches);
                array_push($matches, $unitMatch->id);
            }
//            debug($matches);
            if (count($matches)) {
                return [(count($matches)), $matches[0]];
            } else {
                return false;
            }

        }
    }

    public function assignStaffToUnit()
    {

        $unitList = $this->Units->find('list', [
            'keyField' => 'id',
            'valueField' => 'full_title'
        ])->order(['year'=>'DESC','semester'=>'DESC']);
        $this->set('unitList',$unitList);

        $staffList = $this->Users->find('list',[
           'keyField'=>'id',
           'valueField'=>'full_name'
        ])->where(['role'=>2])->orWhere(['role'=>3])->order(['role'=>'DESC','created'=>'DESC']);
        $this->set('staffList',$staffList);


        $unitsTutorsTable = TableRegistry::getTableLocator()->get('units_tutors');
        if ($this->request->is('post')) {

//            debug($this->request->getData('selectUnit'));
//            debug($this->request->getData('selectStaff'));


            $newUnitsTutor = $unitsTutorsTable->newEntity();
            $unitId = $this->request->getData('selectUnit');
            $staffId = $this->request->getData('selectStaff');

            $unitRecord = $this->Units->find()->where(['id' => $unitId])->first();
            $staffRecord = $this->Users->find()->where(['id' => $staffId])->first();

            $promptUnitInfo = $unitRecord->code . ' ' . 'Semester ' . $unitRecord->semester . ' Year ' . $unitRecord->year;
            $promptStaffInfo = $staffRecord->firstname . ' ' . $staffRecord->lastname;


            $newUnitsTutor->unit_id = $unitId;
            $newUnitsTutor->tutor_id = $staffId;


            if ($unitsTutorsTable->save($newUnitsTutor)) {
                $this->Flash->success($promptStaffInfo . ' has been added to the ' . $promptUnitInfo);
            } else {
                $this->Flash->error('Sorry, ' . $promptStaffInfo . ' can not be added to the ' . $promptUnitInfo);
            }


//            $newUnitsTutors = $unitsTutorsTable->newEntity();
//            $unitCode = $this->request->getData('unitCode');
//            $semester = $this->request->getData('semester');
//            $year = $this->request->getData('year');
//            $staffEmail = $this->request->getData('staffEmail');
//
//            $courseId = $this->Units->find()->where(['code' => $unitCode, 'semester' => $semester, 'year' => $year])->first();
//            $staffRow = $this->Users->find()->where(['email' => $staffEmail])->first();
//            if ($staffRow && $courseId) {
//                $staffId = $staffRow->id;
//                $staffName = $staffRow->firstname . ' ' . $staffRow->lastname;
//
//                $newUnitsTutors->unit_id = $courseId->id;
//                $newUnitsTutors->tutor_id = $staffId;
//                if ($unitsTutorsTable->save($newUnitsTutors)) {
//                    $this->Flash->success("Success!" . $staffName . ' now has been added to the unit ' . $unitCode . ' - Semester' . $semester . ' - Year' . $year);
//                } else {
//                    $this->Flash->error("Failed!" . $staffName . 'cannot be added to the unit ' . $unitCode . ' - ' . $semester . ' - ' . $year);
//                }
//            } else {
//                $this->Flash->error('Unit Or Staff Does not exist in the database; please Double check the input');
//            }

        }


//        Get All Units and all staffs and admins, passing into view


    }

    public function createClasses()
    {

        $unitList = $this->Units->find('list', [
            'keyField' => 'id',
            'valueField' => 'full_title'
        ])->order(['year'=>'DESC','semester'=>'DESC']);
        $this->set('unitList',$unitList);


        $staffList = $this->Users->find('list',[
            'keyField'=>'id',
            'valueField'=>'full_name'
        ])->where(['role'=>2])->orWhere(['role'=>3])->order(['role'=>'DESC','created'=>'DESC']);
        $this->set('staffList',$staffList);

        //            Fetch all records from classes Table;\
        $classesInUnitsClasses = $this->UnitsClasses->find();
        $classesAllRecords = $this->Classes;
        $classesUnitsTable = $this->UnitsClasses;
        $unitsTable = $this->Units;
        $this->set('classesInUnitsClasses', $classesInUnitsClasses);
        $this->set('unitsTable', $unitsTable);
        $this->set('classesUnitsTable', $classesUnitsTable);
        $this->set('classesAllRecords', $classesAllRecords);
        if ($this->request->is('post')) {


            $classesTable = TableRegistry::getTableLocator()->get('classes');
            $unitId = $this->request->getData('selectUnit');
            $staffId = $this->request->getData('selectStaff');
            $classDay = $this->request->getData('classDay');
            $classTime = $this->request->getData('classTime');

            $unitCode = $this->Units->find()->where(['id' => $unitId])->firstOrFail()->code;
            $newClass = $classesTable->newEntity();
            $classInfo = $unitCode . ' - ' . $classDay . ' - ' . $classTime;

            $newClass->class_name = $classInfo;
            $newClass->tutor_id = $staffId;
            if ($classesTable->save($newClass)) {
                $newClassId = $newClass->id;
                $unitsClassesTable = TableRegistry::getTableLocator()->get('units_classes');
                $newUnitsClassEntity = $unitsClassesTable->newEntity();
                $newUnitsClassEntity->class_id = $newClassId;
                $newUnitsClassEntity->unit_id = $unitId;
                if ($unitsClassesTable->save($newUnitsClassEntity)) {
                    $this->Flash->success("New Class has been created & linked to the unit.");
                } else {
                    $this->Flash->error("New Class has been created but unable to link to the unit.");
                }
            }


//            Check if unit exists
//            if ($this->Units->find()->where(['code' => $unitCode, 'semester' => $semester, 'year' => $year])->count()) {
////                fetching unitId for linking classes and units
//                $unitRow = $this->Units->find()->where(['code' => $unitCode, 'semester' => $semester, 'year' => $year])->firstOrFail();
//                $unitId = $unitRow->id;
////            Create classes
//
//                $tutorEmail = $this->request->getData('tutorEmail');
//
//                if ($this->Users->find()->where(['email' => $tutorEmail])->count()) {
//                    $tutorRow = $this->Users->find()->where(['email' => $tutorEmail])->firstOrFail();
//                    $tutorId = $tutorRow->id;
//                    $newClass->tutor_id = $tutorId;
//                    $classInfo = $this->request->getData('classInfo');
//                    $newClass->class_name = $classInfo;
////            $good = false;
//                    if ($classesTable->save($newClass)) {
//                        $newClassId = $newClass->id;
//                        $unitsClassesTable = TableRegistry::getTableLocator()->get('units_classes');
//                        $newUnitsClassEntity = $unitsClassesTable->newEntity();
//                        $newUnitsClassEntity->class_id = $newClassId;
//                        $newUnitsClassEntity->unit_id = $unitId;
//                        if ($unitsClassesTable->save($newUnitsClassEntity)) {
//                            $this->Flash->success("New Class has been created & linked to the unit.");
//                        } else {
//                            $this->Flash->error("New Class has been created but unable to link to the unit.");
//                        }
//
//
//                    } else {
//                        $this->Flash->error("Sorry, The Class cannot be created.");
//                    }
//                } else {
//                    $this->Flash->error("Tutor with " . $tutorEmail . ' does not exist in the database');
//                }
//            } else {
//                $this->Flash->error('Unit Does not found in the database, unable to create classes. Please Check if You enter the right Unit Information.');
//            }
//
//
//        }
        }
    }

    public function createPeerReview()
    {

        $unitList = $this->Units->find('list', [
            'keyField' => 'id',
            'valueField' => 'full_title'
        ])->order(['year'=>'DESC','semester'=>'DESC']);
        $this->set('unitList',$unitList);
        $staffList = $this->Users->find()->where(['role'=>'2'])->orWhere(['role'=>'3']);
        $this->set('staffList',$staffList);
        $peerReviewQuestionTable = TableRegistry::getTableLocator()->get('peer_reviews_questions');

        $questions = $this->paginate($this->Questions);

        $this->set(compact('questions'));

//        get request information from form!;


        if ($this->request->is('post')) {


//            debug($this->request->getData('question'));


//                fetching data from the form

                $unitId = $this->request->getData('selectUnit');
                $start_date = $this->request->getData('start-date');
                $end_date = $this->request->getData('end-date');
                $reminder_date = $this->request->getData('reminder-date');
                $title = $this->request->getData('title');
//            Unit Exists, Proceed;
//            FInd correspond unit row..
//                $unitRecord = $this->Units->find()->where(["code" => $unitCode, "semester" => $semester, "year" => $year])->firstOrFail();
//
//                $unitId = $unitRecord->id;

//            Create a new peer review

                $peerReviewTable = TableRegistry::getTableLocator()->get('peer_reviews');
                $newPeerReview = $peerReviewTable->newEntity();
//            fill the the data from the request like
//            date_start; date_end; date_reminder;title;unit_id;
                $newPeerReview->date_start = $start_date;
                $newPeerReview->date_end = $end_date;
                $newPeerReview->date_reminder = $reminder_date;
                $newPeerReview->title = $title;
                $newPeerReview->unit_id = $unitId;
                if ($peerReviewTable->save($newPeerReview)) {
//               get the newly created peerReview Id;

                    $peer_reviews_id = $newPeerReview->id;
                    $questions = ($this->request->getData('question'));
//               debug($questions);
                    $good = 0;
                    foreach ($questions as $question) {
//                   debug(question);
                        $newPeerReviewQuestion = $peerReviewQuestionTable->newEntity();
                        $newPeerReviewQuestion->peer_reviews_id = $peer_reviews_id;
                        $newPeerReviewQuestion->question_id = $question;
                        $peerReviewQuestionTable->save($newPeerReviewQuestion);
                        $good = 1;
                    }
                    if ($good == 1) {
                        $this->Flash->success('This peer review has been successfully added!');
                    }

                } else {
                    $this->Flash->error("Sorry, Unable to save this Peer Review - " . $newPeerReview->title);
                }

        }


    }

    public function importStaff($unit_id)
    {
        if ($this->request->is('post')) {
            if (null !== ($this->request->getData('Cancel'))) {
                $this->Flash->error('Import cancelled', true);
                return $this->redirect($this->referer());
            }
            $err = false;
            if ($this->request->getData('csvfilename.name') != '') {
                $fileOK = $this->uploadFiles(WWW_ROOT . 'DataImport', $this->request->getData('csvfilename'));
                if (isset($fileOK['errors'])) {
                    $this->Flash->error('Error uploading file - ' . $fileOK['errors'][0] . ' Please, try again.');
                    $err = true;
                } else {
                    $err = false;
                }
            } else {
                $err = true;
                $this->Flash->error('No file chosen. Please select a file');
            }

            $dataCount = 0;
            $dataStatus = [];
            $successData = [];
            $unSuccessData = [];


            if ((!$err)) {
                $filename = WWW_ROOT . "DataImport" . DS . $this->request->getData('csvfilename.name');
                $data = $this->Users->importCsv($filename, array('StaffId', 'Firstname', 'Lastname', 'Email', 'Class'));

                $classArray = [];
                $classArrayUnique = [];
                $peerTable = TableRegistry::getTableLocator()->get('peer_reviews');

                foreach ($data as $key => $value):
                    if ($data[$key]['Email'] == '' and $data[$key]['Firstname'] == '' and ($data[$key]['Lastname'] == '')):
                        unset($data[$key]);
                    endif;

                    if (($data[$key]['Email'] == '') or ($data[$key]['StaffId'] == '') or ($data[$key]['Class'] == '')):
                        array_push($unSuccessData, $data[$key]);
                        unset($data[$key]);
                    endif;

                    array_push($classArray, $data[$key]['Class']);
                    $classArrayUnique = array_unique($classArray);
                endforeach;

                foreach ($classArrayUnique as $class):
                    $className = $class;
                    $classTable = TableRegistry::getTableLocator()->get('classes');
                    $newClass = $classTable->newEntity();
                    $newClass->tutor_id = 15;
                    $newClass->class_name = $className;
                    if (!$classTable->save($newClass)) {
                        // $this->Flash->error('The class could not be saved. Please, try again.');
                    } else {
                        $unit = $classTable->Units->findById($unit_id)->first();
                        if (!$classTable->Units->link($newClass, [$unit])) {
                            //$this->Flash->error('The class-unit could not be saved. Please, try again.');
                        } else {

                        }
                    }
                endforeach;

                foreach ($data as $key => $value):
// User
                    $unitUserSuccess = false;
                    $classUserSuccess = false;
                    $success = 0;
                    $userEmail = $data[$key]['Email'];
                    $arr = explode('@', $userEmail, 2);
                    $userName = $arr[0];
                    $usersTable = TableRegistry::getTableLocator()->get('users');
                    $userQuery = $this->Users->find('all')->where(['email' => $userEmail]);
                    $selectQ = $userQuery->select($this->Users);
                    $selectArray = $selectQ->toArray();

                    if (count($selectArray) == 0) {
                        $newUser = $usersTable->newEntity();
                        $newUser->email = $userEmail;
                        $newUser->firstname = $data[$key]['Firstname'];
                        $newUser->lastname = $data[$key]['Lastname'];
                        $newUser->role = Role::STAFF;
                        $newUser->password = $userName;
                        $newUser->verified = 1;
                        $newUser->studentid = $data[$key]['StaffId'];

                        if (!$usersTable->save($newUser)) {
                            // $this->Flash->error('The user could not be saved. Please, try again.');
                        } else {
                            $unitTutorTable = TableRegistry::getTableLocator()->get('units_tutors');
                            $exists = $unitTutorTable->exists([
                                'unit_id' => $unit_id,
                                'tutor_id' => $newUser->id,
                            ]);
                            if ($exists !== true) {
                                $newUnitTutor = $unitTutorTable->newEntity();
                                $newUnitTutor->unit_id = $unit_id;
                                $newUnitTutor->tutor_id = $newUser->id;
                                if (!$unitTutorTable->save($newUnitTutor)) {
                                    // $this->Flash->error('The class-user could not be saved. Please, try again.');
                                } else {
                                    $unitUserSuccess = true;
                                }
                            }
                            else {
                                $unitUserSuccess = true;
                            }

                            $classTutorTable = TableRegistry::getTableLocator()->get('classes_tutors');
                            $classTable = TableRegistry::getTableLocator()->get('classes');
                            $classQuery = $classTable->find()->where(['class_name'=> $data[$key]['Class']]);
                            $classSelect = $classQuery->select($this->Classes);
                            $classSelectarray = $classSelect->toArray();
                            $chosenClass = $classSelectarray[0];
                            $classTutorExist = $classTutorTable->exists([
                                'class_id' => $chosenClass->id,
                                'tutor_id' => $newUser->id,
                                'unit_id' => $unit_id,
                            ]);
                            if ($classTutorExist !== true) {
                                $newClassTutor = $classTutorTable->newEntity();
                                $newClassTutor->unit_id = $unit_id;
                                $newClassTutor->tutor_id = $newUser->id;
                                $newClassTutor->class_id = $chosenClass['Classes']['id'];
                                if (!$classTutorTable->save($newClassTutor)) {
                                    // $this->Flash->error('The class-user could not be saved. Please, try again.');
                                } else {
                                    $classUserSuccess = true;
                                }
                            }
                            else {
                                $classUserSuccess = true;
                            }

                            if ($unitUserSuccess && $classUserSuccess) {
                                $success = 1;
                                array_push($successData, $value);
                            }
                        }
                    } else {

                        $userArray = [];
                        $userSelect = $userQuery->select($this->Users);
                        foreach ($userSelect as $user) {
                            array_push($userArray, $user);
                        }
                        foreach ($userArray as $user) {
                            $unitTutorTable = TableRegistry::getTableLocator()->get('units_tutors');
                            $exists = $unitTutorTable->exists([
                                'unit_id' => $unit_id,
                                'tutor_id' => $user->id,
                            ]);
                            if ($exists !== true) {
                                $newUnitTutor = $unitTutorTable->newEntity();
                                $newUnitTutor->unit_id = $unit_id;
                                $newUnitTutor->tutor_id = $user->id;
                                if (!$unitTutorTable->save($newUnitTutor)) {
                                    // $this->Flash->error('The class-user could not be saved. Please, try again.');
                                } else {
                                    $unitUserSuccess = true;
                                }
                            }
                            else {
                                $unitUserSuccess = true;
                            }

                            $dataClassName = $data[$key]['Class'];
                            $classTutorTable = TableRegistry::getTableLocator()->get('classes_tutors');
                            $classTable = TableRegistry::getTableLocator()->get('classes');
                            $classQuery = $classTable->find()->where(['class_name'=> $dataClassName]);
                            $classSelect = $classQuery->select($this->Classes);

                            $classSelectArray = $classSelect->toArray();
                            $chosenClass = $classSelectArray[0];
                            $classTutorExist = $classTutorTable->exists([
                                'class_id' => $chosenClass->id,
                                'tutor_id' => $user->id,
                                'unit_id' => $unit_id,
                            ]);
                            if ($classTutorExist !== true) {
                                $newClassTutor = $classTutorTable->newEntity();
                                $newClassTutor->unit_id = $unit_id;
                                $newClassTutor->tutor_id = $user->id;
                                $newClassTutor->class_id = $chosenClass['Classes']['id'];
                                if (!$classTutorTable->save($newClassTutor)) {
                                     $this->Flash->error('The class-user could not be saved. Please, try again.');
                                } else {
                                    $classUserSuccess = true;
                                }
                            }
                            else {
                                $classUserSuccess = true;
                            }

                            if ($unitUserSuccess && $classUserSuccess) {
                                $success = 1;
                                array_push($successData, $value);
                            }
                        }
                    }
                    array_push($dataStatus, $success);
                endforeach;

                $counts = array_count_values($dataStatus);
                if (count($data) > 0) {
                    if (count($counts) > 0) {
                        $message = $counts[true] . " row(s) successfully added";
                        $this->Flash->success($message);
                        $this->set('message', $message);
                        if (count($unSuccessData) > 0) {
                            $errorMessage = "Cannot import data from ";
                            foreach ($unSuccessData as $unSuccessData) {
                                $errorMessage .= $unSuccessData . ' ';
                            }
                            $this->Flash->error($errorMessage);
                        }
                    }
                } else {
                    $this->Flash->error("There's no data in CSV file");
                }

                $this->set('data', $data);
                if (!empty($successData)) {
                    $this->set('successData', $successData);
                }
            }

        }
        $unitQuery = $this->Units->find('all')->where(['id' => $unit_id])->first();
        $this->set('unit',$unitQuery);
    }

    public function importStudent($unit_id)
    {
        if ($this->request->is('post')) {
            if (null !== ($this->request->getData('Cancel'))) {
                $this->Flash->error('Import cancelled', true);
                return $this->redirect($this->referer());
            }
            $err = false;
            if ($this->request->getData('csvfilename.name') != '') {
                $fileOK = $this->uploadFiles(WWW_ROOT . 'DataImport', $this->request->getData('csvfilename'));
                if (isset($fileOK['errors'])) {
                    $this->Flash->error('Error uploading file - ' . $fileOK['errors'][0] . ' Please, try again.');
                    $err = true;
                } else {
                    $err = false;
                }
            } else {
                $err = true;
                $this->Flash->error('No file chosen. Please select a file');
            }

            $dataCount = 0;
            $dataStatus = [];
            $successData = [];
            $unSuccessData = [];


            if ((!$err)) {

                $filename = WWW_ROOT . "DataImport" . DS . $this->request->getData('csvfilename.name');

                $data = $this->Users->importCsv($filename, array('Team', 'StudentId', 'Email', 'Firstname', 'Lastname', 'Class'));

                $teamArray = [];
                $teamArrayUnique = [];
                $classArray = [];
                $classArrayUnique = [];
                $peerTable = TableRegistry::getTableLocator()->get('peer_reviews');


                foreach ($data as $key => $value):
                    if ($data[$key]['Email'] == '' and $data[$key]['Firstname'] == '' and ($data[$key]['Lastname'] == '')):
                        unset($data[$key]);
                    endif;

                    if (($data[$key]['Email'] == '') or ($data[$key]['StudentId'] == '') or ($data[$key]['Class'] == '') or ($data[$key]['Team'] == '')):
                        array_push($unSuccessData, $data[$key]);
                        unset($data[$key]);
                    endif;

                    array_push($teamArray, $data[$key]['Team']);
                    $teamArrayUnique = array_unique($teamArray);
                    array_push($classArray, $data[$key]['Class']);
                    $classArrayUnique = array_unique($classArray);
                endforeach;

                foreach ($teamArrayUnique as $team):
                    $teamName = $team;
                    $teamTable = TableRegistry::getTableLocator()->get('teams');
                    $newTeam = $teamTable->newEntity();
                    $newTeam->name = $teamName;
                    $newTeam->unit_id = $unit_id;
                    if (!$teamTable->save($newTeam)) {
                        // $this->Flash->error('The team could not be saved. Please, try again.');
                    } else {
                        $peerReviewUnit = $peerTable->find()->where(['unit_id' => $unit_id]);
                        $peerReviewUnit->toArray();
                        foreach ($peerReviewUnit as $peerReview):
                            if (!$teamTable->PeerReviews->link($newTeam, [$peerReview])) {
                                $this->Flash->error('The peer-team could not be saved. Please, try again.');
                            } else {

                            }
                        endforeach;
//                        $success .= 'User added to database<br />';
                    }
                endforeach;

                foreach ($classArrayUnique as $class):
                    $className = $class;
                    $classTable = TableRegistry::getTableLocator()->get('classes');
                    $newClass = $classTable->newEntity();
                    $newClass->tutor_id = 15;
                    $newClass->class_name = $className;
                    if (!$classTable->save($newClass)) {
                        // $this->Flash->error('The class could not be saved. Please, try again.');
                    } else {
                        $unit = $classTable->Units->findById($unit_id)->first();
                        if (!$classTable->Units->link($newClass, [$unit])) {
                            //$this->Flash->error('The class-unit could not be saved. Please, try again.');
                        } else {

                        }
                    }
                endforeach;

                foreach ($data as $key => $value):
// User
                    $unitUserSuccess = false;
                    $teamUserSuccess = false;
                    $classUserSuccess = false;
                    $peerUserSuccess = false;
                    $success = 0;
                    $userEmail = $data[$key]['Email'];
                    $arr = explode('@', $userEmail, 2);
                    $userName = $arr[0];
                    $usersTable = TableRegistry::getTableLocator()->get('users');
                    $userQuery = $this->Users->find('all')->where(['email' => $userEmail]);
                    $selectQ = $userQuery->select($this->Users);
                    $selectArray = $selectQ->toArray();
                    if (count($selectArray) == 0) {
                        $newUser = $usersTable->newEntity();
                        $newUser->email = $userEmail;
                        $newUser->firstname = $data[$key]['Firstname'];
                        $newUser->lastname = $data[$key]['Lastname'];
                        $newUser->role = Role::STUDENT;
                        $newUser->password = $userName;
                        $newUser->verified = 1;
                        $newUser->studentid = $data[$key]['StudentId'];

                        if (!$usersTable->save($newUser)) {
                            // $this->Flash->error('The user could not be saved. Please, try again.');
                        } else {

                            $unit = $usersTable->Units->findById($unit_id)->first();
                            if (!$usersTable->Units->link($newUser, [$unit])) {
                                // $this->Flash->error('The unit could not be saved. Please, try again.');
                            } else {
                                $unitUserSuccess = true;
                            }
                            $team = $usersTable->Teams->findByName($data[$key]['Team'])->first();
                            if (!$usersTable->Teams->link($newUser, [$team])) {
                                // $this->Flash->error('The team-user could not be saved. Please, try again.');
                            } else {
                                $teamUserSuccess = true;
                            }
                            $class = $usersTable->Classes->findByClass_name($data[$key]['Class'])->first();
                            if (!$usersTable->Classes->link($newUser, [$class])) {
                                // $this->Flash->error('The class-user could not be saved. Please, try again.');
                            } else {
                                $classUserSuccess = true;
                            }
                            $peerReviewUnit = $peerTable->find()->where(['unit_id' => $unit_id]);
                            $peerReviewUnit->toArray();
                            foreach ($peerReviewUnit as $peerReview):
                                if (!$usersTable->PeerReviews->link($newUser, [$peerReview])) {
                                    //$this->Flash->error('The peer-user could not be saved. Please, try again.');
                                } else {
                                    $peerUserSuccess = true;
                                }
                            endforeach;
                            if ($unitUserSuccess && $peerUserSuccess && $classUserSuccess && $teamUserSuccess) {
                                $success = 1;
                                array_push($successData, $value);
                            }
                        }
                    } else {

                        $userArray = [];
                        $userSelect = $userQuery->select($this->Users);
                        foreach ($userSelect as $user) {
                            array_push($userArray, $user);
                        }
                        foreach ($userArray as $user) {
                            $unit = $usersTable->Units->findById($unit_id)->first();
                            if (!$usersTable->Units->link($user, [$unit])) {
                                // $this->Flash->error('The unit could not be saved. Please, try again.');
                            } else {
                                $unitUserSuccess = true;
                            }
                            $team = $usersTable->Teams->findByName($data[$key]['Team'])->first();
                            if (!$usersTable->Teams->link($user, [$team])) {
                                // $this->Flash->error('The team-user could not be saved. Please, try again.');
                            } else {
                                $teamUserSuccess = true;

//                        $success .= 'User added to database<br />';
                            }
                            $class = $usersTable->Classes->findByClass_name($data[$key]['Class'])->first();
                            if (!$usersTable->Classes->link($user, [$class])) {
                                // $this->Flash->error('The class-user could not be saved. Please, try again.');
                            } else {
                                $classUserSuccess = true;
                            }
                            $peerReviewUnit = $peerTable->find()->where(['unit_id' => $unit_id]);
                            $peerReviewUnit->toArray();
                            foreach ($peerReviewUnit as $peerReview):
                                if (!$usersTable->PeerReviews->link($user, [$peerReview])) {
                                    //$this->Flash->error('The peer-user could not be saved. Please, try again.');
                                } else {
                                    $peerUserSuccess = true;
                                }
                            endforeach;
                            if ($unitUserSuccess && $peerUserSuccess && $classUserSuccess && $teamUserSuccess) {
                                $success = 1;
                                array_push($successData, $value);
                            }
                        }
                    }
                    array_push($dataStatus, $success);
                endforeach;

                $counts = array_count_values($dataStatus);
                if (count($data) > 0) {
                    if (count($counts) > 0) {
                        $message = $counts[true] . " row(s) successfully added";
                        $this->Flash->success($message);
                        $this->set('message', $message);
                        if (count($unSuccessData) > 0) {
                            $errorMessage = "Cannot import data from ";
                            foreach ($unSuccessData as $unSuccessData) {
                                $errorMessage .= $unSuccessData . ' ';
                            }
                            $this->Flash->error($errorMessage);
                        }
                    }
                } else {
                    $this->Flash->error("There's no data in CSV file");
                }

                $this->set('data', $data);
                if (!empty($successData)) {
                    $this->set('successData', $successData);
                }

            }

        }
        $unitQuery = $this->Units->find('all')->where(['id' => $unit_id])->first();
        $this->set('unit',$unitQuery);
    }

    public function create()
    {
        $unitTable = TableRegistry::getTableLocator()->get('units');

        if ($this->request->is('post')) {
            $unitCode = $this->request->getData('unitCode');
            $unitCode = str_replace(' ', '', $unitCode);
            $title = $this->request->getData('title');
            $semester = $this->request->getData('semester');
            $year = $this->request->getData('year');
            $unitMatches = $unitTable->find()->where(['code' => $unitCode, 'semester' => $semester, 'year' => $year]);
            $matches = [];
            foreach ($unitMatches as $unitMatch) {
                array_push($matches, $unitMatch);
            }
            if (count($matches) === 1) {
                $this->Flash->error('Unit Already Existed');
            } else {
                $newUnit = $unitTable->newEntity();
                $newUnit->title = $title;
                $newUnit->code = $unitCode;
                $newUnit->semester = $semester;
                $newUnit->year = $year;

                if ($this->Units->save($newUnit)) {
                    $this->Flash->success(__('The new unit ' . $newUnit->code . ' has been saved.'));

                    return $this->redirect(['controller' => 'admins', 'action' => 'index']);
                } else {
                    $this->Flash->error(__('The new unit ' . $newUnit->code . '  could not be saved. Please, try again.'));
                }

            }
//            debug($matches);
//            echo $unitCode . $semester . $year;
//            debug(count($this->request->getData()));
        }

    }

    public function submit()
    {
        if ($this->request->is('post')) {
            var_dump($this->request->getData());
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

//If user's role is 2(staff), redirect to staff page;
        if (isset($user['role']) && $user['role'] == 2) {

            $this->redirect(['controller' => 'staff', 'action' => 'index']);
        }


//        if (isset($user['role']) && $user['role'] === 'PARTNER') {
//            $this->Auth->allow(['index']);
//        }
//        if (!isset($user['role'])) {
//            $this->Auth->allow(['register','index']);
//        }
    }
}
