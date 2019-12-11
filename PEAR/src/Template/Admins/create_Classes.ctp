<?php
$this->layout = 'default-staff';
//$this->layout = false;
?>


<h1>Create Classes</h1>
<?php
echo $this->Form->create(); ?>
<!--Tutor Email-->
<div class="row mt-5">

        <div class="col-md-6">
            <div class="form-group">
                <?php
                $unitAll = [];
                $staffAll = [];

//                foreach($unitList as $unit){
//                    $unitInformation =array( ''. $unit->id =>$unit->code . ' '.$unit->full_title);
//                    array_push($unitAll,$unitInformation);
//                }
//                foreach($staffList as $staff){
//                    $staffInformation = array(''.$staff->id => $staff->firstname . ' '. $staff->lastname );
//                    array_push($staffAll,$staffInformation);
//                }

                echo $this->Form->input('selectUnit',['required'=>true,'type'=>'select','options'=>$unitList,'label'=>'','showParents' => true,'empty'=>'Select Unit','data-style'=>'btn btn-link','class'=>'form-control']);?>
            </div>

        </div>
<!--        Teaching Period-->

        <div class="col-md-6">
            <div class="form-group bmd-form-group">


                <?php

                $dayAll = array('Mon'=>'Mon','Tue'=>'Tue','Wed'=>'Wed','Thu'=>'Thu','Fri'=>'Fri','Sat'=>'Sat','Sun'=>'Sun');
                echo $this->Form->input('classDay',['required'=>true,'type'=>'select','options'=>$dayAll,'label'=>'','empty'=>'Select Class Day','data-style'=>'btn btn-link','class'=>'form-control']);
                ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group bmd-form-group">
                <?php
                echo $this->Form->input('selectStaff',['required'=>true,'type'=>'select','options'=>$staffList,'label'=>'','empty'=>'Select Staff','data-style'=>'btn btn-link','class'=>'form-control ']);
                ?>
            </div>
        </div>
        <!-- Class Name   -->
    <div class="col-md-6">
        <div class="form-group bmd-form-group">


            <?php

            $timeAll = array('7:00 AM'=>'7:00 AM','7:30 AM'=>'7:30 AM','8:00 AM'=>'8:00 AM',"8:30 AM"=>'8:30 AM',"9:00 AM"=>'9:00 AM',"9:30 AM" =>'9:30 AM',"10:00 AM"=>'10:00 AM',"10:30 AM" => '10:30 AM','11:00 AM' =>'11:00 AM',"11:30 AM" =>'11:30 AM',"12:00 PM" => '12:00 PM',"12:30 PM" =>'12:30 PM',"1:00 PM" => '1:00 PM',"1:30 PM" =>'1:30 PM',"2:00 PM"=>'2:00 PM',"2:30 PM"=>'2:30 PM',"3:00 PM"=>'3:00 PM',"3:30 PM" => '3:30 PM',"4:00 PM" => '4:00 PM',"4:30 PM" => '4:30 PM', "5:00 PM" => '5:00 PM',"5:30 PM" => '5:30 PM',"6:00 PM" => '6:00 PM',"6:30 PM" =>'6:30 PM',"7:00 PM" => '7:00 PM',"7:30 PM" => '7:30 PM',"8:00 PM" => '8:00 PM',"8:30 PM" => '8:30 PM',"9:00 PM" =>'9:00 PM',"9:30 PM" => '9:30 PM',"10:00 PM"=>'10:00 PM');
            echo $this->Form->input('classTime',['required'=>true,'type'=>'select','options'=>$timeAll,'label'=>'','empty'=>'Select Class Time','data-style'=>'btn btn-link','class'=>'form-control']);
            ?>
        </div>
    </div>
        <!--Semester-->

</div>



<br>
<!--    <input type="checkbox" name="question1" value="Do you like your team?"> Do you like your team?<br>-->
<!--    <input type="checkbox" name="question2" value="Do you want to work with your teammates in the future?"> Do you want to work with your teammates in the future?<br>-->
<!--    <input type="checkbox" name="question3" value="How do you like Your mentors?" checked> How do you like Your mentors? <br><br>-->
<?= $this->Form->submit('Submit',['class'=>'btn btn-primary pull-right']);?>
<?php echo $this->Form->end();?>

<h1>All Classes</h1>


    <table id="myTable" class="material-datatables">
        <thead>
            <th>Class Info</th>
            <th>Year</th>
            <th>Semester</th>

        </thead>
        <tbody>
        <?php
//找到class_id // 去到classTable// 找到 class name// / 找到所有Class表所有實例 / 提取class_id / 找到classesUnits 表所有實例 / 找出對應的unitId / 找到UnitTables表中所有實例 找出Year屬性
        foreach($classesInUnitsClasses as $class):?>
        <tr>

            <?php
            $className = $classesAllRecords->find()->where(['id'=>$class->class_id])->first()->class_name;
//            debug($className);
            $classId = $classesAllRecords->find()->where(['id'=>$class->class_id])->first()->id;
//            debug($classId);
            $unitId = $classesUnitsTable->find()->where(['class_id'=>$classId])->first()->unit_id;
//            debug($unitId);
            $year = $unitsTable->find()->where(['id'=>$unitId])->first()->year;
//            debug($year);
            $semester = $unitsTable->find()->where(['id'=>$unitId])->first()->semester;
//            debug($semester);

            ?>
            <td><?=$className?></td>
            <td><?=$year?></td>
            <td><?=$semester?></td>
        </tr>

        <?php endforeach;?>
        </tbody>
    </table>




<script>
    // Create Peer Review highlight Tab
    const ccTab = document.querySelector('#cc');
    ccTab.classList.add('active');
    const submit = document.querySelector('.submit');
    submit.classList.add('m-auto');

    //    "<i class=\"material-icons\">create</i>"
    //     const submitBtn = document.querySelector('#submit-btn');
    //     let submitIcon = document.createElement('i');
    //     submitBtn.setAttribute("class",'material-icons');
    //     submitBtn.innerText = 'create';
    // //
    //     submitBtn.appendChild(submitBtn);
</script>
