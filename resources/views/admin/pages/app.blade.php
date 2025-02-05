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


</head>
<style>

    html {
      margin: 0;
      padding: 0;
    }

    body {
      background-color: #f8f9fa; /* Subtle gray background for elegance */
      font-family: 'Arial', sans-serif;
    }
  
    .table-container {
      margin: 2rem 1rem; /* Not centered, more natural flow */
      padding: 1.5rem;
      background: #ffffff;
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
  </style>
  

<body>
    @include('admin.pages.header')
    <div class="w-100">
      <div class="container-fluid w-100">
    
    @yield('content')
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
          
          if(message) {
            const div = document.createElement('div');
              div.classList.add('alert', 'alert-success', 'fade', 'show');
              div.role = 'alert';
              div.innerHTML = message

              document.getElementById('alertContainer').appendChild(div);

              localStorage.removeItem('success');

              setTimeout(() => {
                div.remove();
              }, 3000);
          }
        
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