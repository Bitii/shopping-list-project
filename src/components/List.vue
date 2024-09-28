<template>
    <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>To-Do list
	</title>
	<link rel="stylesheet" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	</head>
<body>
	<section class="vh-100">
		<div class="container py-5 h-100">
		  <div class="row d-flex justify-content-center align-items-center h-100 ">
			<div class="col col-xl-10">
	  
			  <div class="card" style="border-radius: 15px;">
				<div class="card-body p-5">
	  
				  <h6 class="mb-3">Todo List</h6>
	  
				  <form class="d-flex justify-content-center align-items-center mb-4 ">
					<div class="form-outline flex-fill">
					  <input type="text" id="inputT" class="form-control form-control-lg" />
					  <label class="form-label" for="form3">What do you need to do today?</label>
					</div>
					<button type="submit" class="btn btn-primary btn-lg ms-2" id="addB">Add</button>
				  </form>

				  <ul class="nav nav-tabs nav-fill " id="navbar" role="tablist">
					<li class="nav-item" role="presentation">
					  <a class="nav-link" id="all" data-mdb-toggle="tab" role="tab" href="#all"
						aria-controls="ex1-tabs-1" aria-selected="true" onclick="selectView(event)">All</a>
					</li>
					<li class="nav-item" role="presentation">
					  <a class="nav-link" id="active" data-mdb-toggle="tab"  role="tab" href="#active"
						aria-controls="ex1-tabs-2" aria-selected="false" onclick="selectView(event)">Active</a>
					</li>
					<li class="nav-item" role="presentation">
					  <a class="nav-link" id="completed" data-mdb-toggle="tab"  role="tab" href="#completed"
						aria-controls="ex1-tabs-3" aria-selected="false" onclick="selectView(event)">Completed</a>
					</li>
				  </ul>

				  <ul class="list-group mb-0" id="todoList">
					 
				
				  </ul>
	  
				</div>
			  </div>
	  
			</div>
		  </div>
		</div>
	  </section>
	<script src="app.js"></script>
</body>
</html>
</template>

<script>
// Main parts of html side for user interaction
const todoInput = document.getElementById('inputT');
const addButton = document.getElementById('addB');
const todoList = document.getElementById('todoList');
const activeMenu = document.getElementById('active');
const allMenu = document.getElementById('all');
const completedMenu = document.getElementById('completed');

// Arrays for 3 types of tasks 
let activeList = JSON.parse(sessionStorage.getItem('todoTask')) || [];
let completedList = JSON.parse(sessionStorage.getItem('completedTask')) || [];
let allTasks = JSON.parse(sessionStorage.getItem('todoTask')) || [];

// Random generated id for tasks
function randomId() {
  let S4 = function() {
     return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
  };
  return (S4()+S4());
}

// Task added to list via input typed by user
 addButton.addEventListener('click', function addToDo(event)  {
  event.preventDefault();
      if (todoInput.value == ''){
        alert ('You have to type something');
      } 
      else  {
        const todoTask = {
          id: randomId(),
          text: todoInput.value,
          isDone: false
        }
      if (window.location.href.indexOf('#all') > -1 || window.location.href.indexOf('#active') > -1) {
        const newTodo = document.createElement('div');
        newTodo.innerHTML =  
        `<li id="${todoTask.id}" class="list-group-item justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom pb-0 mb-0">
         <p class="pb-1 mb-1"><input class="form-check-input me-2" type="checkbox" onclick="completeToDo(event); "/>${todoInput.value}</p>
        </li>`;
        
      todoList.appendChild(newTodo);

      } else if (window.location.href.indexOf('#completed') > -1 ) {
        console.log('Nothing to display here')
      }

      
      activeList.push(todoTask);
      sessionStorage.setItem('todoTask', JSON.stringify(activeList));
      
      allTasks.push(todoTask);
      sessionStorage.setItem('todoTask', JSON.stringify(allTasks));

      todoInput.value = '';
    }
  }
);
        

  // Checked checkboxes make todo texts line through
function completeToDo(event) {
    
  let selectedText = event.target.parentNode;
  let selectedId = event.target.parentNode.parentNode.id;
  let selectedDiv = event.target.parentNode.parentNode.parentNode;
  selectedText.classList.toggle('text-decoration-line-through'); 
  
  let index = allTasks.map(todoTask => {
    return todoTask.id;}).indexOf(selectedId);
    if (allTasks[index].isDone == false){
    allTasks[index].isDone == false
    ? (allTasks[index].isDone = true) 
    : (allTasks[index].isDone = false);

    const completedTask = {
      id: selectedId,
      text: selectedText.innerText,
      isDone:allTasks[index].isDone
    };

    JSON.parse(sessionStorage.getItem('todoTask'));
    activeList.splice(index, 1);
    sessionStorage.setItem('todoTask', JSON.stringify(allTasks));

    completedList.push(completedTask);
    sessionStorage.setItem('completedTask', JSON.stringify(completedList));
    

  // With timeout the selected task is removed from display
  if (window.location.href.indexOf('active') > -1)
{  setTimeout(function() {
    selectedDiv.classList.toggle('visually-hidden');
      }, 3000);
  }    
// Undo the completed task 
      } else if (allTasks[index].isDone == true) {
      let index = allTasks.map(completedTask => {
        return completedTask.id;}).indexOf(selectedId);
      allTasks[index].isDone == true
    ? (allTasks[index].isDone = false) 
    : (allTasks[index].isDone = true);

      const completedTask = {
        id: selectedId,
        text: selectedText.innerText,
        isDone:allTasks[index].isDone
      };
      if (window.location.href.indexOf('completed') > -1 )
    {
      setTimeout(function() {
      selectedDiv.classList.toggle('visually-hidden');
    }, 3000);
  }
      completedList.splice(index.completedTask, 1);
      sessionStorage.removeItem('completedTask');
      activeList.push(completedTask);
      sessionStorage.setItem('todoTask', JSON.stringify(allTasks));
      
    }
  }




// Display rendering based on the user's selected menu
function selectView(event)  {
  // Show all tasks added by the user
  if (event.target.id == 'all') {

    todoList.innerHTML = allTasks.map(todoTask => 
      `<div>
        <li id="${todoTask.id}" class="list-group-item justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom pb-0 mb-0">
          <p class="pb-1 mb-1 ${todoTask.isDone}"><input class="form-check-input me-2" type="checkbox" onclick="completeToDo(event);"/>${todoTask.text}</p> 
          </li>
      </div>    
    `).join('');
    console.log('all');
    let completed = document.querySelectorAll('.true');
    for(let i = 0; i < completed.length; i++) {
    completed[i].classList.add('text-decoration-line-through');
    completed[i].firstElementChild.checked = true;
    }
  }
  // Only show tasks which are not completed yet
  if (event.target.id == 'active') {
    JSON.parse(sessionStorage.getItem('todoTask'));
    todoList.innerHTML =activeList.map(todoTask => 
      `<div>
        <li id="${todoTask.id}" class="list-group-item justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom pb-0 mb-0">
          <p class="pb-1 mb-1 ${todoTask.isDone}"><input class="form-check-input me-2" type="checkbox" onclick="completeToDo(event); "/>${todoTask.text}</p>
        </li>
     </div>    
     `).join('');
    console.log('active');
    let completed = document.querySelectorAll('.true');
    for(let i = 0; i < completed.length; i++) {
    completed[i].parentNode.classList.add('visually-hidden');
    completed[i].firstElementChild.checked = true;
    }
  }
  // Only show tasks which are completed yet
  if (event.target.id == 'completed') {
  
  todoList.innerHTML =completedList.map(completedTask => 
    `<div>
      <li id="${completedTask.id}" class="list-group-item justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom pb-0 mb-0">
       <p class="pb-1 mb-1 text-decoration-line-through"><input class="form-check-input me-2" type="checkbox" onclick="completeToDo(event); " checked />${completedTask.text}</p>
      </li>
    </div>    
    `).join('');
    
    console.log('completed');
  }
}
</script>