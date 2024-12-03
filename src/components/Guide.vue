<template>
    <div id="guide">
      <h1>How to Use This App</h1>
      
      <section class="step">
        <h2>Step 1: Add Items</h2>
        <p>Type the name of the item in the input box at the top of the page. After typing, click the "Add" button. The item will be added to the list.</p>
      </section>
  
      <section class="step">
        <h2>Step 2: Mark Items as Bought</h2>
        <p>
          Each item in the list has a checkbox on the left. When you click on the checkbox, the item's text will have a line through it, 
          indicating that it is marked as bought.
        </p>
        <p>
          Bought items will automatically appear in the "Bought" section, while items that are not yet bought will remain in the "Active" section.
        </p>
      </section>
  
      <section class="step">
        <h2>Step 3: View Items</h2>
        <p>
          The app has three views:
          <ul>
            <li><strong>All:</strong> Displays all items, whether bought or not.</li>
            <li><strong>Active:</strong> Shows items that are not yet bought.</li>
            <li><strong>Bought:</strong> Shows items that have been marked as bought.</li>
          </ul>
        </p>
      </section>
  
      <section class="step">
        <h2>Step 4: Remove Items</h2>
        <p>
          Each item has a red "Remove" button. Clicking this button will delete the item from the list entirely, no matter which section it's in.
        </p>
      </section>
      <section class="step">
        <h2>Step 5: Edit Items</h2>
        <p>
          To edit an item, click the "Edit" button. The item's text will become an input field. After editing, press "Save" to save the changes or if you change your mind, just press the Cancel button and the changes will not be save.
        </p>
      </section>
  
      <section class="note">
        <h2>Note</h2>
        <p>You can switch between the "Active," "Bought," and "All" views anytime using the provided tabs or buttons in the app interface.</p>
      </section>
      <router-link style="text-decoration: none;" to="/list">
        <button class="btn btn-primary">
            Back to the site
        </button>

      </router-link>
      <RouterView />

    </div>


  </template>
  
  <script>
import { RouterLink } from 'vue-router';

  export default {
    name: "Guide",
  };
  </script>
  
  <style>
.btn {
    margin-top: 2rem;
    font-size: 1em;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.5s ease;
}
.btn-primary {
    background-color: #007bff;
    color: #ffffff;
}
.btn-primary:hover {
  background-color: #0056b3;
}


  #guide {
    font-family: Arial, sans-serif;
    
    margin: 0 auto;
    background-color: skyblue;
    padding: 2rem;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
    color: black;
  }
  
  h1 {
    text-align: center;
    margin-bottom: 30px;
  }
  
  .step {
    margin-bottom: 20px;
  }
  
  h2 {

  }
  
  p {
    line-height: 1.6;

  }
  
  ul {
    margin: 10px 0;
    padding-left: 20px;
  }
  
  li {
    margin-bottom: 5px;
  }
  
  .note {
    margin-top: 30px;
    background-color: #f9f9f9;
    padding: 15px;
    border-left: 5px solid #007bff;
    border-radius: 0.5rem;
    box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);
  }
  </style>