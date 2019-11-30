


$('[id^=sliderA_]').on("change", function(slideEvt) {
    let isHide = slideEvt.currentTarget.value === '0';
    let checkId = slideEvt.currentTarget.id.replace('sliderA_','checkA_');
    document.getElementById(checkId).style.display = isHide ? "none" : "";
});

$("#survey-form").submit(function (event) {
    let sliderGroup = $('[id^=sliderA_]');

    for (let i = 0; i < sliderGroup.length; i++ )
    {
        if(sliderGroup[i].value === "0")
        {
            event.preventDefault();
            $("html, body").animate({
                scrollTop: $("#"+sliderGroup[i].name).offset().top }, {duration: 500,easing: "swing"});
            return;
        }
    }

    alert("success");
    event.preventDefault();
});
