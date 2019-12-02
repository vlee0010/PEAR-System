


$('[id^=sliderA_]').on("change", function(slideEvt) {
    let isHide = slideEvt.currentTarget.value === '0';
    let checkId = slideEvt.currentTarget.id.replace('sliderA_','checkA_');
    let exId = checkId.replace("checkA","EXA");
    document.getElementById(checkId).style.display = isHide ? "none" : "";
    document.getElementById(exId).style.display = isHide ? "" : "none";
});

$("#survey-form").submit(function (event) {
    let sliderGroup = $('[id^=sliderA_]');
    let firstErr = 0;

    for (let i = 0; i < sliderGroup.length; i++ )
    {
        let exId = sliderGroup[i].id.replace('sliderA_', 'EXA_');

        if(sliderGroup[i].value === "0")
        {
            if(firstErr === 0)
            {
                firstErr = sliderGroup[i].name;
            }


            document.getElementById(exId).style.display =  "";
            event.preventDefault();
        }
        else
        {
            document.getElementById(exId).style.display =  "none";
        }
    }

    if(firstErr !== 0) {
        $("html, body").animate({
            scrollTop: $("#" + firstErr).offset().top
        }, {duration: 500, easing: "swing"});
    }
});
