$(document).ready(function() {
  const baseUrl = "http://htudemo.local";
  
  $('#login-form').submit(function(event) {
    event.preventDefault();
  
    let username = $('#user').val();
    let password = $('#pass').val();
  
    $.ajax({
      url: baseUrl + '/authenticate',
      type: 'post',
      data: {
        username: username,
        password: password
      },
     
      success: function(data, status, xhr) {
        data= JSON.parse(data);
        console.log(data);
        console.log(data['status']);
        if (data.status == "admin") {
          window.location.href = '/sales';
        } else if(data.status == "inactive") {
          console.log("Executing else if block with data: 'inactive'");
          console.log("Calling swal.fire()");
          swal.fire({
            title: "Incorrect login!",
            text: "you are inactive!",
            icon: "warning",
            showCancelButton: false,
            confirmButtonText: 'OK',
          })
          .then((result) => {
            console.log("swal.fire() result:", result);
          });       
        }else if (data.status == "user") {
          window.location.href = '/users';
        }else {
          console.log('Executing else block with data:', data);
          swal.fire({
            title: "Incorrect login!",
            text: "Incorrect username or password!",
            icon: "warning",
            showCancelButton: false,
            confirmButtonText: 'OK',
          });        
        }
      }
    });
  });
  
    $('#pass').on('input', function() {
      var password = $('#pass').val();
      var requirements = [];
    
      if (!/[a-z]/.test(password)) {
        requirements.push('<li>A lowercase letter</li>');
      }
    
      if (!/[A-Z]/.test(password)) {
        requirements.push('<li>An uppercase letter</li>');
      }
    
      if (!/\d/.test(password)) {
        requirements.push('<li>A number</li>');
      }
    
      if (!/[$@$!%*?&]/.test(password)) {
        requirements.push('<li>A symbol</li>');
      }
    
      if (password.length < 8) {
        requirements.push('<li>At least 8 characters</li>');
      }
    
      if (requirements.length > 0) {
        var message = 'Your password must contain the following:';
        message += requirements.join('');
        $('#password-requirements').html(message);
      } else {
        $('#password-requirements').html('');
     
      }
    });
    
    $('#repeat').on('input', function() {
      var repeatPassword = $('#repeat').val();
      var password = $('#pass').val();
    
      if (repeatPassword !== password) {
        $('#password-match').text('Passwords do not match');
      } else {
        $('#password-match').text('');
      }
      
    });
    
    

    $('#signup-form').submit(function(event) {
      event.preventDefault();
    
      let username = $('#user').val();
      let password = $('#pass').val();
      let email = $('#email').val();
      let repeat =$('#repeat').val();
    
      $.ajax({
        url: baseUrl + '/sign',
        type: 'post',
        data: {
          username: username,
          password: password,
          email: email,
          repeat: repeat
        },
        success: function(data, status, xhr) {
          console.log(data);
          if (data == "true") {
            window.location.href = '/';
          } else if (data == "matches") {
            swal.fire({
              title: "Incorrect signup!",
              text: "The password didn't match the repeat password!",
              icon: "warning"
            });
          } else {
            swal.fire({
              title: "Incorrect signup!",
              text: "The password should meet all requirements and should match the repeat password!",
              icon: "warning"
            });
          }
        }
      });
    });
    
    $.ajax({
        
              type: "GET",
              url: baseUrl + "/transactions",
              success: function (response) {
                  response.body.forEach(element => {
                    if(element.status=="1"){
                       element.status="Active";
                    }else{
                      element.status="Inactive"
                    }
                      $('table').append(`
                          <tr data-id=${element.id}>
                              <td class="text-center" username-id=${element.id}>${element.username}</td>
                              <td class="text-center" email-id=${element.id}>${element.email}</td>
                              <td class="text-center" status-id=${element.id}>${element.status}</td>
                              <td edit-id=${element.id} class="text-center"><button class="btn btn-outline-warning p-2"><i class="fa-solid fa-edit p-2"></i></button></td>
                              <td delete-id=${element.id} class="text-center"><button class="btn btn-outline-danger p-2"><i class="fa-solid fa-trash p-2"></i></button></td>
                              </tr>     
                   `);
                    const newRow=  $(`td[status-id="${element.id}"]`);
                    if (element.status == "Active") {
                      newRow.removeClass('red');
                      newRow.addClass('green');
                    } else {
                      newRow.removeClass('green');
                      newRow.addClass('red');
                    }
                   $(`td[delete-id=${element.id}]`).click(function() {
                    Swal.fire({
                      title: 'Are you sure you want to delete this user ?',
                      text: "You won't be able to revert this!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $.ajax({
                          type: "DELETE",
                          url: baseUrl + '/transactions/delete',
                          data: JSON.stringify({ id: element.id }),
                          success: function(response) {
                            $(`tr[data-id="${element.id}"]`).remove();
                            Swal.fire(
                              'Deleted!',
                              'the user has been deleted.',
                              'success'
                            );
                          },
                          error: function() {
                            Swal.fire(
                              'Error',
                              'An error occurred while deleting the user.',
                              'error'
                            );
                          }
                        });
                      }
                    })
                   
                })
                $(`td[edit-id=${element.id}]`).click(function() {
                  $.ajax({
                    type: "POST",
                    url:baseUrl+ "/user/single",
                    data:{
                      id:element.id
                    },
                    success: function(response) {
                      console.log(response);
                      console.log(response.body["email"]);
                      Swal.fire({
                        title: 'Edit the user',
                        html:
                          '<input id="username" class="swal2-input" placeholder="username"value="' + response.body["username"]+ '">' +
                          '<input id="email" class="swal2-input" placeholder="email" value="' + response.body["email"]+ '">'+
                          '<select id="status" class="swal2-select">' +
                          '<option value="' + response.body["status"]+ '">select status</option>' +
                          '<option value="1">Active</option>' +
                          '<option value="0">Inactive</option>' +
                          '</select>'+
                          '<select id="role" class="swal2-select">' +
                          '<option value="' + response.body["role"]+ '">select Role</option>' +
                          '<option value="admin">Admin</option>' +
                          '<option value="user">user</option>' +
                          '</select>',
                        showCancelButton: true,
                        confirmButtonText: 'Submit',
                        preConfirm: () => {
                          return new Promise((resolve) => {
                            // get the form data
                           
                            let username=$('#username').val();
                            let email=$('#email').val();
                            let status=$('#status').val();
                            let role=$('#role').val();
                            
                            // send the AJAX request
                            $.ajax({
                              type: "POST",
                              url:baseUrl+ "/transactions/update",
                              data: {
                                 id: element.id,
                                 username:username,
                                 email:email,
                                 role:role,
                                 status:status
    
                                 },
                              success: function(response) {
                                // response=JSON.stringify(response);
                                // response = JSON.parse(response);
                                if(response.body['status']=="1"){
                                  response.body['status']="Active";
                                  $(`td[status-id="${element.id}"]`).removeClass('red');
                                  $(`td[status-id="${element.id}"]`).addClass('green');
                               }else{
                                 response.body['status']="Inactive";
                                 $(`td[status-id="${element.id}"]`).removeClass('green');
                                 $(`td[status-id="${element.id}"]`).addClass('red');
                               }
                                console.log(response);
                                console.log(response.body['username']);
                                console.log(response.body['id']);
                                
                                $(`td[username-id="${element.id}"]`).text(response.body['username']);
                                $(`td[email-id="${element.id}"]`).text(response.body['email']);
                                $(`td[status-id="${element.id}"]`).text(response.body['status']);
                                
                                // update the content of a div with the response from the server
                                
                      
                                // resolve the promise to close the SweetAlert
                                resolve();
                              },
                              error: function() {
                                // handle the error here
                      
                                // reject the promise to keep the SweetAlert open
                                reject(Error('Network Error'));
                              }
                            });
                          });
                        },
                      }).then((result) => {
                        if (result.isConfirmed) {
                          console.log('Form submitted successfully!');
                        }
                      });
                    },
                  
                  });
               

                  

                })
                  
                  })
                }
                
            });
           
                
  });
 
                
  


