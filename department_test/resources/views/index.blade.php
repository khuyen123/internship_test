<!DOCTYPE html>
<html lang="zxx">
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div style=' height:600px; width:1000px;margin-left:150px;' >
            <h1 style='text-align:center'>
                Team Management
            </h1>
            <div style='display:flex'>
                <div style='width:500px;height:450px;margin-left:30px; border: solid 1px'>
                    <table style='border:solid 0.5px;margin-left:20px' >
                        <tr>
                            <h3 style='text-align:center'>Danh sách Team</h3>
                            <div style='display:flex' >
                                <button onclick="gohome()" type='button' style='border:solid 1px black;margin:0 0 10px 20px; height:24px;width:40px;background-color:#57d0eb'>
                                    <i class='fa fa-home' ></i>
                                </button>
                                <input style='margin-left:20px;margin-bottom:10px' type="radio" id="azsort" name="azsort" value="azsort">
                                <label style='margin-top:4px' for="azsort">A-Z</label>
                                <input style='margin-left:20px;margin-bottom:10px' type="radio" id="zasort" name="azsort" value="azsort">
                                <label style='margin-top:4px' for="zasort">Z-A</label>
                                <form action="{{route('search')}}" method = "GET">
                                    <input style='border:solid 1px black;margin:0 0 10px 25px;width:130px; height:20px'
                                    type="text" placeholder='Nhập từ khoá' id='searchString' name='searchString'>
                                    <button  type='submit' style='border:solid 1px black;margin:0 0 10px 20px; height:24px;width:40px;background-color:#57d0eb'>
                                        <i class='fa fa-search' ></i>
                                    </button>
                                    @csrf
                                </form>
                               <a href="/team/export">
                               <button type='button' style='border:solid 1px black;margin:0 0 10px 20px; height:24px;width:40px;background-color:#57d0eb'>
                                        <i class='fa fa-download' ></i>
                                </button>
                               </a>
                            </div>
                        </tr>
                        <tr style='background-color:#689fe8' >
                            <td onclick="sortID()" style='width:70px'>Mã Team</td>
                            <td onclick="sortName()" style='width:150px' >Tên Team</td>
                            <td style='width:150px'>Tên Bộ Phận</td>
                            <td style='width:70px' >Chọn</td>
                        </tr>
                        @foreach($teams as $team)
                        <tr>
                            <td>{{$team->team_id}}</td>
                            <td>{{$team->team_name}}</td>
                            <td>{{$team->department->department_name}}</td>
                            <td>
                                <button onclick="selectTeam('{{$team->team_id}}')" style='background-color:#57d0eb'>
                                    <i style='font: size 20px;' class="fa fa-info-circle" ></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>
                <div style='width:400px;height:450px; margin-left:30px;border:solid 1px;'>
                    <h3 style='text-align:center;'>Thao Tác</h3>
                    <form action="">
                        <div style='width: 360px;height:400px; margin:10px 0 0 20px; padding-top:20px' >
                            <div style='width: 320px; height:80px; margin-left:20px;display:flex'>
                                <h4>Mã Team:</h4>
                                <input readonly id='team_id' name='team_id' style='border:solid 1px black;width:200px;height:30px;margin-left:20px;margin-top:15px' type="text" placeholder='Nhập mã team'/>       
                            </div>
                            <div style='width: 320px; height:80px; margin-left:20px; display:flex'>
                                <h4 >Tên team:</h4>
                                <input readonly id='team_name' name='team_name' style='border:solid 1px black;width:200px;height:30px;margin-left:20px;margin-top:15px' type="text" placeholder='Nhập tên team'/>
                            </div>
                            <div style='width: 320px; height:80px; margin-left:20px;display:flex'>
                                <h4 >Bộ phận:</h4>
                                <select disabled='true' id="department_id" name='department_id' style='border:solid 1px black;width:200px;height:30px;margin-left:30px;margin-top:15px'  name="" id="">
                                    @foreach($departments as $department)
                                        <option id='department_id{{$department->department_id}}' value="{{$department->department_id}}">{{$department->department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style='width: 320px; height:80px; margin-left:20px;display:flex'>
                                <button id="addButton" type="button" onclick="add_button()" style='background-color:#78d166;margin-left:20px;height:40px;width:80px;margin-top:5px;color:white'>Thêm</button>
                                <button id="editButton" type="button" onclick="edit_button()"style='background-color:#dbc33b;margin-left:20px;height:40px;width:80px;margin-top:5px;color:white'>Sửa</button>
                                <button id="deleteButton" type="button" onclick="delete_button()" style='background-color:#f0624f;margin-left:20px;height:40px;width:80px;margin-top:5px;color:white' >Xoá</button>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
           
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //Go home:
        function gohome(){
            location.href = '/'
        }
        // varible 'buttonfunction' to see what the 'add' buttom do.
        // 0 - to add a new team
        // 1 - submit to add a new team
        // 2 - submit to edit a selected team
        var buttonfunction = 0;
        var data = []
        $(document).ready(function(){
            document.getElementById("department_id").disabled = true;
            document.getElementById("team_id").readOnly = true;
            document.getElementById("team_name").readOnly = true;
            document.getElementById("deleteButton").disabled = true;
            document.getElementById("editButton").disabled = true;
        })
        //select a team in list to display
        function selectTeam(id){
            $.ajax({
                type: "Get",
                url: "/team/find/"+id,
                datatype :"json",
                success: function(response){
                    $('#team_id').val(response.team.team_id);
                    $('#team_name').val(response.team.team_name);
                    document.getElementById("department_id"+response.team.department_id).selected = true
                    document.getElementById("department_id").disabled = true;
                    document.getElementById("team_id").readOnly = true;
                    document.getElementById("team_name").readOnly = true;
                    document.getElementById("deleteButton").disabled = false;
                    document.getElementById("editButton").disabled = false;
                }
            }); 
        }
        function add_button(){
             //can't submit when team_id == null 
            document.getElementById("addButton").disabled = true;
                //Check to see if the team_id is null 
                $(document).on('keyup','#team_id',function(){
                    document.getElementById("addButton").disabled = false;
                    document.getElementById("team_id").style.borderColor = "black"
                    //warn user if team_id is null
                    if ($('#team_id').val().length == 0 && buttonfunction == 1){
                        document.getElementById("addButton").disabled = true
                        document.getElementById("team_id").style.borderColor = "red"
                    }
                    //Warn user if team_id reached max of length (20)
                    if ($('#team_id').val().length >= 20){
                        document.getElementById("addButton").disabled = true
                        document.getElementById("team_id").style.borderColor = "red"
                    }
                })
                //Check to see if team_name reached max of length (50)
                $(document).on('keyup','#team_name',function(){
                    document.getElementById("addButton").disabled = false
                    document.getElementById("team_name").style.borderColor = "black"
                    //warn user to see if team_name reached max of length
                    if ($('#team_name').val().length >= 50){
                        document.getElementById("addButton").disabled = true
                        document.getElementById("team_name").style.borderColor = "red"
                    }
                })
            if (buttonfunction == 1) {
                //submit to add a new team to database
                //set data for a new team
                var data = {
                        'team_id': $('#team_id').val(),
                        'team_name': $('#team_name').val(),
                        'department_id': document.getElementById('department_id').value
                    }
                //send ajax to add new team
                $.ajax({
                    type:"POST",
                    data: data,
                    url: '/team/create',
                    dataType: 'JSON',
                    success: function(response){
                        if (response.status == '200') {
                            Swal.fire(
                                'Thành công',
                                'Thêm Team mới thành công',
                                'success'
                            ).then(function(){
                                location.reload()
                            })
                        } 
                        if (response.status == '404') {
                            swal.fire(
                                'Thất bại',
                                'Thêm Team mới thất bại',
                                'error'
                            ).then(function(){
                                location.reload()
                            })
                        }
                    }
                })
            } else if (buttonfunction == 2){
                //submit to edit a team to database
                //Set data to edit
                data = {
                        'team_id': $('#team_id').val(),
                        'team_name': $('#team_name').val(),
                        'department_id': document.getElementById('department_id').value
                    }
                //Send ajax to edit selected team to database
                $.ajax({
                    type:"POST",
                    data: data,
                    url: '/team/update/'+$('#team_id').val(),
                    dataType: 'JSON',
                    success: function(response){
                        if (response.status == '200') {
                            Swal.fire(
                                'Thành công',
                                'Chỉnh sửa Team thành công',
                                'success'
                            ).then(function(){
                                location.reload()
                            })
                        } 
                        if (response.status == '404') {
                            swal.fire(
                                'Thất bại',
                                'Chỉnh sửa Team thất bại',
                                'error'
                            ).then(function(){
                                location.reload()
                            })
                        }
                    }
                })
            } else{
                //set buttonfunction to 1 and setup adding display
                buttonfunction = 1
                document.getElementById("department_id").disabled = false
                document.getElementById("team_id").readOnly = false
                document.getElementById("team_name").readOnly = false
                document.getElementById("team_id").value = ''
                document.getElementById("team_name").value = ''
                document.getElementById("addButton").innerHTML = 'Xác nhận'
                document.getElementById("deleteButton").innerHTML='Huỷ'
                document.getElementById("deleteButton").disabled = false
                document.getElementById("editButton").style.visibility = "hidden";
            }
        }
        function edit_button(id){
            //Check to see if team_name reached max of length (50)
            $(document).on('keyup','#team_name',function(){
                    document.getElementById("addButton").disabled = false
                    document.getElementById("team_name").style.borderColor = "black"
                    //warn user to see if team_name reached max of length
                    if ($('#team_name').val().length >= 50){
                        document.getElementById("addButton").disabled = true
                        document.getElementById("team_name").style.borderColor = "red"
                    }
                    
            })
            //set buttonfunction to 2.
            buttonfunction = 2
            team_id = $('#team_id').val()
            document.getElementById("team_name").readOnly = false
            document.getElementById("department_id").disabled = false
            document.getElementById("addButton").innerHTML = 'Xác nhận'
            document.getElementById("deleteButton").innerHTML='Huỷ'
            document.getElementById("editButton").style.visibility = "hidden"
        }
        function delete_button(){ 
            //return to home if add or edit is in process
            if (buttonfunction == 1 || buttonfunction==2) {
                returnhome()
            } else {
                //delete a selected team
                var team_id = $('#team_id').val()
                Swal.fire({
                    title: 'Bạn có muốn thực hiện hành động này không?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Xác nhận'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: '/team/delete/'+team_id,
                            success: function(response) {
                                if (response.status == '200') {
                                    swal.fire(
                                        'Thành công',
                                        'Xoá Team thành công',
                                        'success'
                                    ).then(function(){
                                        location.reload()
                                    })
                                } 
                                if (response.status == '404') {
                                    swal.fire(
                                        'Thất bại',
                                        'Xoá Team thất bại',
                                        'error'
                                    ).then(function(){
                                        location.reload()
                                    })
                                }
                            }
                        })
                    }
                })
                
            }
        }
        function returnhome(){
            //return to the default display
            document.getElementById("team_id").value = ''
            document.getElementById("team_name").value = ''
            document.getElementById("department_id").disabled = true;
            document.getElementById("team_id").readOnly = true;
            document.getElementById("team_name").readOnly = true;
            document.getElementById("deleteButton").disabled = true;
            document.getElementById("deleteButton").innerHTML='Xoá'
            document.getElementById("editButton").disabled = true;
            document.getElementById("editButton").style.visibility = "visible"
            document.getElementById("addButton").innerHTML = 'Thêm'
            document.getElementById("addButton").disabled = false
            document.getElementById("team_id").style.borderColor = "black"
            document.getElementById("team_name").style.borderColor = "black"
            buttonfunction = 0
        }
        function sortID(){
            var sortaz = document.getElementById('azsort').checked
            var sortza = document.getElementById('zasort').checked
            
            //check to see which sort is checked
            if (sortaz) {
                location.href = '/team/sortIdaz'
            }
            if (sortza) {
                location.href= '/team/sortIdza'
            }  
        }
        function sortName(){
            var sortaz = document.getElementById('azsort').checked
            var sortza = document.getElementById('zasort').checked
            //check to see which sort is checked
            if (sortaz) {
                location.href = '/team/sortNameaz'
            }
            if (sortza) {
                location.href= '/team/sortNameza'
            }  
        }
    </script>
</html>