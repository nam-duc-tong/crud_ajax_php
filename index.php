<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>PHP OOP PDO AJAX CRUD TUTORIAL</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">

                <h1 class="text-center">PHP  OOP PDO AJAX CRUD TUTORIAL</h1>
                <hr style="height: 1px;color: black;background-color: black;">
        </div>
    </div>
        <div class="row">
            <div class="col-md-5 mx-auto">
                    <form action="" method="post" id="form">
                        <div id="result"></div>
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="description" cols="" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                    </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-1">
                <div id="show"></div>
                <div id="fetch"></div>
            </div>
        </div>
    </div>
</div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Single Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="read_data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<!-- Edit Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="edit_data"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
-->
<script>
    $(document).on("click","#submit",function(e){
        e.preventDefault();

        var title = $("#title").val();
        var description = $("#description").val();
        var submit = $("#submit").val();

        $.ajax({
            url: "insert.php",
            type: "post",
            data:{
                title: title,
                description: description,
                submit: submit
            },
            success:function(data){
                fetch();
                $("#result").html(data);
            }
        });


        $("#form")[0].reset();
    });

//     fetch record
    function fetch()
    {
        $.ajax({
            url: "fetch.php",
            type: "post",
            success: function(data){
                $("#fetch").html(data);
            }

        });
    }
    fetch();
// delete record
    $(document).on("click","#del",function(e)
    {
        e.preventDefault();
        if(window.confirm("do you want delete records"))
        {
            var del_id = $(this).attr("value");
            $.ajax({
                url: "del.php",
                type: "post",
                data: {
                    del_id: del_id
                },
                success: function(data)
                {
                    fetch();
                    $("#show").html(data);
                }
            });
        }
        else{
            return false;
        }
    });
// read record
    $(document).on("click","#read",function(e){
        e.preventDefault();
        var read_id = $(this).attr("value");
        $.ajax({
            url: "read.php",
            type: "post",
            data: {
                read_id: read_id
            },
            success: function(data){
                $("#read_data").html(data);
            }
        });

    });

//     edit record
    $(document).on("click","#edit",function(e){
        e.preventDefault();
        var edit_id = $(this).attr("value");
        $.ajax({
            url: "edit.php",
            type: "post",
            data:{
                edit_id: edit_id
            },
            success: function(data){
                $("#edit_data").html(data);
            }
        });
    });
//     update record
    $(document).on("click","#update",function(e){
        e.preventDefault();
        var edit_title = $("#edit_title").val();
        var edit_description = $("#edit_description").val();
        var update = $("#update").val();
        var edit_id = $("#edit_id").val();

        $.ajax({
            url: "update.php",
            type: "post",
            data:{
                edit_id: edit_id,
                edit_title: edit_title,
                edit_description: edit_description,
                update: update
            },
            success:function(data){
                fetch();
                $("#show").html(data);
            }

        })
    });
</script>
</body>
</html>