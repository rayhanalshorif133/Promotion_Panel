$(function () {
    $(".operatorEditBtn").click(function () {
        const id = $(this).parent().attr('data-id');
        axios.get(`operator/fetch/${id}`)
            .then(function (res) {
                const data = res.data.data;
                $("#operator_id").val(data.id);
                $("#updateName").val(data.name);
                $("#updateStatus").val(data.status);
            });
    });

    $(".operatorDeleteBtn").click(function () {
        const id = $(this).parent().attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`operator/delete/${id}`)
                    .then(function (res) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    });
                    
            }
        })
    });
});
