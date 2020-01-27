<?php
$this->layout = 'default-staff';
//$this->layout = false;
?>

<style>
    .select2-container--default .select2-selection--single{
        border:none;
        background-color: transparent;
    }

    @keyframes example {
        from {background-color: lightgoldenrodyellow;}
        to {background-color: white;}
    }

    ul{
        list-style: none;
    }

    .example-animation{
        animation-name:exmaple;
        animation-duration: 4s;
    }
</style>

<h1>Assign Staff To Class</h1>
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

            echo $this->Form->input('selectUnit',['required'=>true,'type'=>'select','options'=>$unitList,'label'=>'','showParents' => true,'empty'=>'Select Unit','data-style'=>'btn btn-link','class'=>'form-control simple js-example-basic-single','id'=>'selectUnit','value'=>$unit_id]);?>
        </div>

    </div>
    <!--        Teaching Period-->

    <div class="col-md-6">
        <div class="form-group bmd-form-group">

            <?php echo $this->Form->input('selectStaff',['required'=>true,'type'=>'select','options'=>$staffList,'label'=>'','showParents' => true,'empty'=>'Select Staff','data-style'=>'btn btn-link','class'=>'form-control simple js-example-basic-single','id'=>'selectStaff','value'=>$staff_id]);?>

        </div>
    </div>

    <!-- Class Name   -->
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <?php echo $this->Form->input('selectClass',['required'=>true,'type'=>'select','label'=>'','showParents' => true,'empty'=>'Select Class','data-style'=>'btn btn-link','class'=>'form-control simple js-example-basic-single','id'=>'selectClass']);?>

        </div>
    </div>
    <!--Semester-->

</div>



<br>
<!--    <input type="checkbox" name="question1" value="Do you like your team?"> Do you like your team?<br>-->
<!--    <input type="checkbox" name="question2" value="Do you want to work with your teammates in the future?"> Do you want to work with your teammates in the future?<br>-->
<!--    <input type="checkbox" name="question3" value="How do you like Your mentors?" checked> How do you like Your mentors? <br><br>-->
<button class="btn btn-primary pull-right">Submit
</button>
<?php echo $this->Form->end();?>

<h2>Classes associated with selected unit: </h2>
<ul id="ajax" class="list-group"></ul>



<script>
    // Create Peer Review highlight Tab
    const acTab = document.querySelector('#ac');
    acTab.classList.add('active');
    const submit = document.querySelector('button.btn.btn-primary.pull-right');
    submit.classList.add('m-auto');


    $(document).ready(function() {

        $('.js-example-basic-single').select2();
        // $('.simple').select2();
        $('#selectUnit').on('select2:select', function(e){
            console.log($('#selectUnit').val());
            $selectedUnitId = $('#selectUnit').val();
            var classDropdown = document.querySelector('#selectClass');
            searchRelevantClasses($selectedUnitId);
        });
        $('#selectStaff').on('select2:select',function(e){
            console.log($('#selectStaff').val());
        });
        $('#selectUnit').on('change', function(e){
            var classDropdown = document.querySelector('#selectClass');
            classDropdown.innerHTML='';
            $selectedUnitId = $('#selectUnit').val();
            searchRelevantClasses($selectedUnitId);
        })

        document.querySelector("button.btn.btn-primary.pull-right").addEventListener('click', function(e){
            let unitCode = document.querySelector("select[name='selectUnit']").value;
            let staffId = document.querySelector("select[name='selectStaff']").value;
            let classId = document.querySelector("select[name='selectClass']").value;
            if (unitCode != '' && staffId != '' && classId != ''){
                // addRelevantClasses(unitCode,classDay,classTime);

            }else{
                alert('Please select all inputs');
            }

        })

        function addRelevantClasses(unitId, classDay, classTime){
            console.log("unit id: " + unitId + ' classDay: ' + classDay + ' classTime: ' + classTime);
            $.ajax({
                method: 'POST',
                url:"<?php echo $this->Url->build(['controller'=>'admins','action'=>'addClassViaAjax'])?>",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('X-CSRF-Token','<?php echo $this->request->getParam('_csrfToken')?>')
                },
                data: {"tutor_id":1,"unit_id": unitId,"class_day": classDay,"class_time": classTime},
                success: function(response){
                    if(response.length != 0){
                        console.log(response);
                        console.log("responseName: "+response.name);
                        var ulList = document.querySelector('#ajax');
                        var noClassP = document.querySelector('.noClass');
                        if(ulList.contains(noClassP)){
                            console.log(ulList.contains(noClassP))
                            noClassP.remove();
                        }
                        // ulList.innerHTML = '';
                        let li = document.createElement('li');
                        li.setAttribute('class','list-group-item');
                        li.setAttribute('class','example-animation');
                        li.textContent = response.name;
                        console.log('Hooooray');
                        ulList.appendChild(li);
                        // response.forEach(function(e){
                        //     var li = document.createElement('li');
                        //     li.setAttribute('class','list-group-item');
                        //     li.textContent = e.class_name;
                        //     console.log(li);
                        //     ulList.appendChild(li);
                        // })
                    }else{

                        var ulList = document.querySelector('#ajax');
                        ulList.innerHTML = '';
                        console.log(ulList.children == '');
                        console.log(ulList.childNodes);
                        if(ulList.childNodes.length == 0){
                            console.log(3);
                            var p = document.createElement('h4');
                            p.setAttribute('class','text-gray noClass');
                            p.textContent = "There is no class for this unit yet." ;
                            ulList.appendChild(p);

                        }
                    }
                }
            })
        }

        function searchRelevantClasses(unitId){
            var classDropdown = document.querySelector('#selectClass');
            // classDropdown.empty()
            // classDropdown.empty();
            var data =unitId;
            console.log('ahahahahaha');
            $.ajax({
                method: 'POST',
                url:"<?php echo $this->Url->build(['controller'=>'admins','action'=>'returnRelevantClasses'])?>",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('X-CSRF-Token','<?php echo $this->request->getParam('_csrfToken')?>')
                },
                data: {unitId:data},
                success:function(response){
                    if(response.length != 0){

                        var ulList = document.querySelector('#ajax');
                        ulList.innerHTML = '';
                        response.forEach(function(e){
                            console.log(e);
                            var li = document.createElement('li');
                            li.setAttribute('class','list-group-item');
                            li.setAttribute('class','example-animation');
                            li.textContent = e.class_name;
                            console.log(li);
                            ulList.appendChild(li);
                            var classDropdown = document.querySelector('#selectClass');
                            var option = document.createElement('option');
                            option.textContent = e.class_name;
                            option.value = e.id;
                            classDropdown.add(option);



                        })
                    }else{

                        var ulList = document.querySelector('#ajax');
                        ulList.innerHTML = '';
                        let noOption = document.createElement('option');
                        noOption.textContent = 'no Class';
                        var classDropdown = document.querySelector('#selectClass');
                        // classDropdown.add(noOption);
                        if(ulList.childNodes.length == 0){
                            var p = document.createElement('h4');
                            p.setAttribute('class','text-gray noClass');
                            p.textContent = "There is no class for this unit yet." ;
                            ulList.appendChild(p);
                        }
                    }



                }
            })
        }
    });


    // fetch form data;





</script>
