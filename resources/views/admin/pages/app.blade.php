<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/icon.png') }}">

</head>
<style>

    html {
      margin: 0;
      padding: 0;
    }

    body {
      background-image: url('https://mdci.edu.ph/assets/web/images/Metro-Dumaguete-Colleges-School-Campus-1-1210x423.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Arial', sans-serif;
        min-height: 100vh;
    }
    
    .container-fluid {
      min-height: 100vh;
    }
  
    .table-container {
      margin: 2rem 1rem; /* Not centered, more natural flow */
      padding: 1.5rem;
      /* background: #ffffff; */
      border-radius: 8px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Minimal shadow for modern design */
    }
  
    h2 {
      color: #333;
      font-weight: 600;
      font-size: 1.5rem;
      text-align: left; /* Align header to the left */
    }
  
    .table {
      margin-bottom: 2rem;
      border-collapse: collapse;
      
    }
  
    .table thead th {
      background: #e9ecef; /* Light gray for table headers */
      color: #495057;
      text-align: center;
      font-size: 0.95rem;
      padding: 0.75rem;
      border: 1px solid #dee2e6;
    }
  
    .table tbody td {
      text-align: center;
      vertical-align: middle;
      padding: 0.75rem;
      border: 1px solid #dee2e6;
      color: #212529;
      font-size: 0.9rem;
    }
  
    .table tbody tr:hover {
      background: #f1f3f5; /* Subtle hover effect */
    }
  
    .badge {
      font-size: 0.85rem;
      padding: 0.3rem 0.5rem;
      border-radius: 0.25rem;
    }
  
    .badge-present {
      background: #28a745; /* Subtle green */
      color: #fff;
    }
  
    .badge-late {
      background: #ffc107; /* Subtle yellow */
      color: #fff;
    }
  
    .badge-absent {
      background: #dc3545; /* Subtle red */
      color: #fff;
    }
  
    .final-grade {
      font-weight: bold;
      color: #007bff; /* Subtle blue */
    }

    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

    body {
        font-family: 'Roboto', sans-serif;
        /* background-color: #f8f9fa; */
        /* background-image: url('https://scontent.fceb2-1.fna.fbcdn.net/v/t39.30808-6/468980236_1662637201298722_2838240459680541657_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeEGW7_VXgPtOR5_lLbiCq82NCuRPDwVQ6c0K5E8PBVDp3HI8LmZJD8p9baLmfP-Eqi1GO7cXzoyfp36C3uZR2sV&_nc_ohc=kucwihXwNjcQ7kNvgFUQ6gg&_nc_oc=AdjmA1BxDLoMOK81A9HWFK2aSFXJq1jYBt8mQ0yD92SBg4TbHTIGNFj8rH6kTBM6LaLZaUAwL_aAF3cU6ZfmbuzD&_nc_zt=23&_nc_ht=scontent.fceb2-1.fna&_nc_gid=A5myqNBfKY0t6GRcPCoUT8A&oh=00_AYBzau1y6qkhicRFynV5nMllOkqKidVkRi43r5KWcGtwQA&oe=67B011C2'); */
        
    }

    /* Card design for batches */
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        /* background-color: #ffffff; */
        color: #343a40;
        text-align: center;
        padding: 20px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-success {
        background-color: #4caf50;
        border: none;
        color: white;
        font-weight: bold;
        padding: 10px 15px;
    }

    .btn-success:hover {
        background-color: #388e3c;
    }

    /* Header design */
    .header-section {
        background-color: #e9ecef;
        padding: 20px 25px;
        border-left: 5px solid #4caf50;
        margin-bottom: 20px;
        border-radius: 8px;
    }

    /* Footer design */
    footer {
        background-color: #343a40;
        color: #ffffff;
        padding: 15px;
        text-align: center;
        border-top: 2px solid #4caf50;
        margin-top: 40px;
        border-radius: 8px 8px 0 0;
    }

    .batch-record {
        color: #6c757d;
        font-size: 1.1rem;
    }

    /* Modal Styling */
    .modal-header {
        background-color: #f1f1f1;
        border-bottom: 1px solid #ddd;
    }

    .modal-footer {
        border-top: 1px solid #ddd;
    }

    @media (max-width: 767px) {
        .card {
            font-size: 1rem;
        }
    }
  </style>
  

<body>
    @include('admin.pages.header')
    <div class="w-100 content">
      <div class="container-fluid w-100">
    
    @yield('content')
    </div>
    @include('admin.pages.footer')
  </div>
  
    <!-- Bootstrap 4 JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>


    document.addEventListener('DOMContentLoaded', () => {
        const attendanceCell = document.querySelectorAll('.attendance-cell');

        

        function updateCell(cell) {
            
       
            const studentId = event.target.closest('tr').getAttribute('data-student-id'); // Assuming each row has a data-student-id attribute
            const column = cell.getAttribute('data-column'); // e.g., A1, A2, etc.
            const value = cell.textContent;
            
            console.log(`Student ID: ${studentId}, Column: ${column}, Value: ${value}`);

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/handler', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken  },
                body: JSON.stringify({ student_id: studentId, column, value })
            }).then(response => {
                if (!response.ok) {
                    return response.text().then(text => { throw new Error(text); });
                }
                return response.json();
            }) .then(data => {
              
              if(data.success) {
                localStorage.setItem("success", data.message);
                localStorage.setItem("successStatus", "success");
                location.reload();
              } else {
                localStorage.setItem("success", data.message);
                localStorage.setItem("successStatus", "danger");
                location.reload();
              }
            })
            // .then(data => console.log('Updated successfully!'))
            .catch(error => console.error('Error:', error));
            

          }

          attendanceCell.forEach(cell => {
            cell.addEventListener('keydown', (event) => {
              if(event.key === 'Enter') {
                event.preventDefault();
                updateCell(cell)
              }
            })
          });

          attendanceCell.forEach(cell => {
            cell.addEventListener('blur', (event) => {
                updateCell(cell)
              
            })
          });

          const message = localStorage.getItem('success');
          const messageStatus = localStorage.getItem('successStatus');
          console.log(messageStatus)

          function messageStatusNotif(status , messages) {
            if(status) {
                const div = document.createElement('div');
                div.classList.add('alert', `alert-${status}`, 'fade', 'show');
                div.role = 'alert';
                div.innerHTML = messages

                document.getElementById('alertContainer').appendChild(div);

                localStorage.removeItem('success');
                localStorage.removeItem('successStatus');

                setTimeout(() => {
                  div.remove();
                }, 500);
            }
          }

          messageStatusNotif(messageStatus, message);
          
          // if(messageStatus == true) {
          //   messageStatusNotif('success', message);
          // } else {
          //   messageStatusNotif('danger', message);
          // }
        
    });


    const messageAlert = document.querySelectorAll('.messageAlert');

    messageAlert.forEach(alert => {
      setTimeout(() => {
        alert.remove();
      }, 3000)
    });
    

    </script>
  </body>

  </html>