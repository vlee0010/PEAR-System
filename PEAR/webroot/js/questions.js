


$('[id^=sliderA_]').on("change", function(slideEvt) {
    let isHide = slideEvt.currentTarget.value === '0';
    let checkId = slideEvt.currentTarget.id.replace('sliderA_','checkA_');
    document.getElementById(checkId).style.display = isHide ? "none" : "";
});
