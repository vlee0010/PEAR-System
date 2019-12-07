


$('[id^=sliderA_]').on("change", function(slideEvt) {
    let isHide = slideEvt.currentTarget.value === '0';
    let checkId = slideEvt.currentTarget.id.replace('sliderA_','checkA_');
    let errorId = checkId.replace("check","message");

    document.getElementById(checkId).style.display = isHide ? "none" : "";
    document.getElementById(errorId).style.display = isHide ? "" : "none";
});

$("#survey-form").submit(function (event) {
    let sliderGroup = $('[id^=sliderA_]');
    let firstErr = -1;

    for (let i = 0; i < sliderGroup.length; i++ )
    {
        let errorId = sliderGroup[i].id.replace('sliderA_', 'messageA_');

        if(sliderGroup[i].value === "0")
        {
            if(firstErr === -1)
            {
                firstErr = sliderGroup[i].name;
            }


            document.getElementById(errorId).style.display =  "";
            event.preventDefault();
        }
        else
        {
            document.getElementById(errorId).style.display =  "none";
        }
    }

    if(firstErr !== -1) {
        $("html, body").animate({
            scrollTop: $("#" + firstErr).offset().top
        }, {duration: 500, easing: "swing"});
    }
});
