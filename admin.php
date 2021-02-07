











<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<style type="text/css">
#overlay{
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.6);
}
</style>
</head>
<body>
<div id="app">
    <div class="container-fluid">
        <div class="row bg-dark">
          <div class="col-lg-12">
           <p class="text-center text-light display-4 pt-2" style="font-size: 20px;">appliction</p>
          </div>
        </div>
    </div>
   <div>
       <div class="container" style="margin: auto;">
           <div class="row mt-3">
            <div class="col-lg-6">
                <h3 class="text-into">registered</h3>
            </div>
            <div class="col-lg-6">
                <button class="btn btn-info float-right" @click="showAddModal=true">
                    <i class="fas fa-user" ></i>&nbsp;&nbsp;add
                </button> 
            </div>
           </div>
           <hr class="bg-info">
           <div class="alert alert-danger" v-if="errorMsg">
               {{errorMsg}}
           </div>
           <div class="alert alert-success" v-if="successMsg">
            {{successMsg}}
        </div>
        <div class="row">
          <div class="col-lg-12">
              <table class="table table-bordered table-striped">
                  <thead>
                  <tr class="text-conter bg-info text-light">
                      <th>ID</th>
                      <th>name</th>
                      <th>email</th>
                      <th>phone</th>
                      <th>edit</th>
                      <th>delete</th>
                  </tr>
                </thead>
                <tbody>
                    <tr class="text-conter" v-for="user in users">
                       <td>{{user.id}}</td>
                       <td>{{user.name}}</td>
                       <td>{{user.email}}</td>
                       <td>{{user.phone}}</td>
                       <td><a href="#" class="text-success" @click="showEditModal=true; selectUser(user)"><i class="fas fa-edit"></i></a></td>
                       <td><a href="#" class="text-danger" @click="showDeletModal=true; selectUser(user)"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                </tbody>
              </table>
           </div>
        </div>
       </div>
   </div>
   <div id="overlay" v-if="showAddModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
             <h5 class="modal-title">add new user</h5>
             <button type="button" class="closre" @click="showAddModal=false" >
                 <span aria-haspopup="true">&times;</span>
             </button>
            </div>
            <div class="modal-dody p-4">
                <form action="#" method="post">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control form-control-lg" placeholder="name" v-model="newUser.name" >&nbsp;&nbsp;
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="e-mail" v-model="newUser.email" >&nbsp;&nbsp;
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" class="form-control form-control-lg" placeholder="phone" v-model="newUser.phone" >&nbsp;&nbsp;
                    </div>
                    <div class="form-group">
                       <button class="btn btn-info btn-block btn-lg" @click="showAddModal=false;addUser();clearMeg();">add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="overlay" v-if="showEditModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
             <h5 class="modal-title">edit new user</h5>
             <button type="button" class="closre" @click="showEditModal=false" >
                 <span aria-haspopup="true">&times;</span>
             </button>
            </div>
            <div class="modal-dody p-4">
                <form action="#" method="post">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control form-control-lg" v-model="currentUser.name" >&nbsp;&nbsp;
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-lg" v-model="currentUser.email" >&nbsp;&nbsp;
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" class="form-control form-control-lg"v-model="currentUser.phone" >&nbsp;&nbsp;
                    </div>
                    <div class="form-group">
                       <button class="btn btn-info btn-block btn-lg" @click="showEditModal=false;updateUser();clearMeg();">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="overlay" v-if="showDeletModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
             <h5 class="modal-title">delet user</h5>
             <button type="button" class="closre" @click="showDeletModal=false" >
                 <span aria-haspopup="true">&times;</span>
             </button>
            </div>
            <div class="modal-dody p-4">
                <h4 class="text-danger" >are you sure want to delete this users?</h4>
                <h5>you do   {{currentUser.name}}</h5>
                <hr>
                <button class="btn btn-danger btn-lg" @click="showDeletModal=false;deleteUser();clearMeg();">yes</button>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-success btn-lg" @click="showDeletModal=false">no</button>
            </div>
        </div>
    </div>
</div>

</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script type="text/JavaScript" src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script type="text/JavaScript" src="main.js"></script>

    
</body>
</html>