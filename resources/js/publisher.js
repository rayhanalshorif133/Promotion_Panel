$(function () {
    $(".publisherEditBtn").click(function () {
        const id = $(this).parent().attr('data-id');
        console.log(id);
        axios.get(`publisher/fetch/${id}`)
            .then(function (res) {
                const data = res.data.data;
                $("#publisher_id").val(data.id);
                $("#updateName").val(data.name);
                $("#updateShortName").val(data.short_name);
                $("#updateStatus").val(data.status);
            });
    });

    $(".publisherDeleteBtn").click(function () {
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
                axios.delete(`publisher/delete/${id}`)
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
