$(function(){
    handleRatioErrorMsg();
});


const handleRatioErrorMsg = () => {
    $("#campaign_create_ratio").keyup(function(){
        let ratio = $(this).val();
        if(ratio > 1){
            $(this).val(1);
            $("#ratioErrorMsg").text("Ratio must be less than 1");
        }else{
            $("#ratioErrorMsg").text("");
        }
    });
}