$(function(){
    $(".operatorEditBtn").click(function(){
        const id = $(this).parent().attr('data-id');
        axios.get(`operator/fetch/${id}`)
            .then(function(res){
                const data = res.data.data;
                $("#operator_id").val(data.id);
                $("#updateName").val(data.name);
                $("#updateStatus").val(data.status);
            });
    });
});
