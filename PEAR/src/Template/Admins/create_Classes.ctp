<?php
$this->layout = 'default-staff';
//$this->layout = false;
?>
<style>
    .select2-container--default .select2-selection--single{
        border:none;
        background-color: transparent;
    }
</style>

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

                echo $this->Form->input('selectUnit',['required'=>true,'type'=>'select','options'=>$unitList,'label'=>'','showParents' => true,'empty'=>'Select Unit','data-style'=>'btn btn-link','class'=>'form-control js-example-basic-single','id'=>'selectUnit','value'=>$unit_id]);?>
            </div>

        </div>
<!--        Teaching Period-->

        <div class="col-md-6">
            <div class="form-group bmd-form-group">


                <?php

                $dayAll = array('Mon'=>'Mon','Tue'=>'Tue','Wed'=>'Wed','Thu'=>'Thu','Fri'=>'Fri','Sat'=>'Sat','Sun'=>'Sun');
                echo $this->Form->input('classDay',['required'=>true,'type'=>'select','options'=>$dayAll,'label'=>'','empty'=>'Select Class Day','data-style'=>'btn btn-link','class'=>'form-control js-example-basic-single']);
                ?>
            </div>
        </div>

        <!-- Class Name   -->
    <div class="col-md-6">
        <div class="form-group bmd-form-group">


            <?php

            $timeAll = array('7:00 AM'=>'7:00 AM','7:30 AM'=>'7:30 AM','8:00 AM'=>'8:00 AM',"8:30 AM"=>'8:30 AM',"9:00 AM"=>'9:00 AM',"9:30 AM" =>'9:30 AM',"10:00 AM"=>'10:00 AM',"10:30 AM" => '10:30 AM','11:00 AM' =>'11:00 AM',"11:30 AM" =>'11:30 AM',"12:00 PM" => '12:00 PM',"12:30 PM" =>'12:30 PM',"1:00 PM" => '1:00 PM',"1:30 PM" =>'1:30 PM',"2:00 PM"=>'2:00 PM',"2:30 PM"=>'2:30 PM',"3:00 PM"=>'3:00 PM',"3:30 PM" => '3:30 PM',"4:00 PM" => '4:00 PM',"4:30 PM" => '4:30 PM', "5:00 PM" => '5:00 PM',"5:30 PM" => '5:30 PM',"6:00 PM" => '6:00 PM',"6:30 PM" =>'6:30 PM',"7:00 PM" => '7:00 PM',"7:30 PM" => '7:30 PM',"8:00 PM" => '8:00 PM',"8:30 PM" => '8:30 PM',"9:00 PM" =>'9:00 PM',"9:30 PM" => '9:30 PM',"10:00 PM"=>'10:00 PM');
            echo $this->Form->input('classTime',['required'=>true,'type'=>'select','options'=>$timeAll,'label'=>'','empty'=>'Select Class Time','data-style'=>'btn btn-link','class'=>'form-control js-example-basic-single']);
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
<h2>Classes associated with this unit: </h2>
<ul id="ajax" class="list-group"></ul>



<script>
    // Create Peer Review highlight Tab
    const ccTab = document.querySelector('#cc');
    ccTab.classList.add('active');
    const submit = document.querySelector('.submit');
    submit.classList.add('m-auto');


    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $('#selectUnit').on('select2:select', function(e){
            console.log($('#selectUnit').val());
            $selectedUnitId = $('#selectUnit').val();
            searchRelevantClasses($selectedUnitId);
        })

        function searchRelevantClasses(unitId){
            var data =unitId;
            $.ajax({

                method: 'POST',
                url:'/admins/returnRelevantClasses',
                beforeSend: function(xhr){
                    xhr.setRequestHeader('X-CSRF-Token','<?php echo $this->request->getParam('_csrfToken')?>')
                },
                data: {unitId:data},
                success:function(response){
                    console.log(response);
                    if(response.length != 0){
                    console.log(response.length);
                    var ulList = document.querySelector('#ajax');
                        ulList.innerHTML = '';
                    response.forEach(function(e){
                        var li = document.createElement('li');
                        li.setAttribute('class','list-group-item');
                        li.textContent = e.class_name;
                        console.log(li);
                        ulList.appendChild(li);
                    })
                    }else{

                        var ulList = document.querySelector('#ajax');
                        ulList.innerHTML = '';
                        console.log(ulList.children == '');
                        console.log(ulList.childNodes);
                        if(ulList.childNodes.length == 0){
                            console.log(3);
                            var p = document.createElement('h4');
                            p.setAttribute('class','text-gray ');
                            p.textContent = "There is no class for this unit yet." ;
                            var emoji = document.createElement('span');
                            emoji.innerText = "&#129488;";
                            p.appendChild(emoji);
                            ulList.appendChild(p);
                        }
                    }



                }
            })
        }
    });





</script>
