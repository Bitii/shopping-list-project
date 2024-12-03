<template>
  <section class="vh-100">
    <div class="container">
            
      <div class="row">
        <div class="col">
          <div class="card">
            <router-link style="text-decoration: none;" to="/guide">
            <div class="info-box">
                        <a class="info-icon">?</a>
                      </div>
            </router-link>
            <div class="card-body">
              <h6 class="mb-3">Shopping list</h6>
              <form class="form" @submit.prevent="addItem">
                <div class="form-outline">
                  <input type="text" v-model="newItem" class="form-control" placeholder="What do you want to buy?" />
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
              </form>
              <ul class="nav-tabs" id="navbar" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link" :class="{ active: view === 'all' }" @click="selectView('all')" role="tab">All</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" :class="{ active: view === 'active' }" @click="selectView('active')"
                    role="tab">Active</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" :class="{ active: view === 'completed' }" @click="selectView('completed')"
                    role="tab">Bought</a>
                </li>
              </ul>
              <div class="tab-content">
                <div v-if="view === 'all' || view === 'active'" class="tab-pane show active">
                  <ul class="list-group">
                <li v-for="item in filteredItems" :key="item.id" class="list-group-item">
                  <div v-if="!item.editMode" class="d-flex align-items-center">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      :checked="item.completed"
                      @change="toggleItem(item.id)"
                    />
                    <span :class="{ 'text-decoration-line-through': item.completed }">
                      {{ item.text }}
                    </span>
                    
                  </div>
                  <div v-else class="d-flex align-items-center">
                    <input
                      type="text"
                      v-model="item.text"
                      class="form-control me-2"
                      @keyup.enter="disableEdit(item.id)"
                    />
                    <button class="btn btn-edit" @click="disableEdit(item.id)">Save</button>
                    <button class="btn btn-danger btn-edit " @click="cancelEdit(item)">Cancel</button>
                  </div>
                  <button class="btn " v-if="!item.editMode" @click="enableEdit(item.id)">Edit</button>
                  <button class="btn btn-danger" @click="removeItem(item.id)">Remove</button>
                </li>
              </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script setup>
import { ref, computed, watch } from 'vue';

const newItem = ref('');
const items = ref(JSON.parse(localStorage.getItem('shoppingList')) || []); 
const view = ref('all');
const originalItemText = ref('');


const saveToLocalStorage = () => {
  localStorage.setItem('shoppingList', JSON.stringify(items.value));
};


const addItem = () => {
  if (newItem.value.trim() !== '') {
    items.value.push({ id: Date.now(), text: newItem.value, completed: false, editMode: false });
    newItem.value = '';
    saveToLocalStorage(); 
  }
};


const toggleItem = (id) => {
  const item = items.value.find((item) => item.id === id);
  if (item) {
    item.completed = !item.completed;
    saveToLocalStorage(); 
  }
};


const removeItem = (id) => {
  items.value = items.value.filter((item) => item.id !== id);
  saveToLocalStorage();
};


const selectView = (selectedView) => {
  view.value = selectedView;
};


const enableEdit = (id) => {
  const item = items.value.find((item) => item.id === id);
  if (item) {
    originalItemText.value = item.text;
    item.editMode = true;
  }
};


const disableEdit = (id) => {
  const item = items.value.find((item) => item.id === id);
  if (item) {
    item.editMode = false;
    saveToLocalStorage(); 
  }
};


const cancelEdit = (item) => {
  item.text = originalItemText.value;
  item.editMode = false;
};


const filteredItems = computed(() => {
  if (view.value === 'active') {
    return items.value.filter((item) => !item.completed);
  } else if (view.value === 'completed') {
    return items.value.filter((item) => item.completed);
  }
  return items.value;
});


watch(items, saveToLocalStorage, { deep: true });
</script>

<style scoped>
body {
  background-color: #f0f2f5;
  font-family: 'Roboto', sans-serif;
}

.vh-100 {
  height: 100vh;
}

.container {
  background-color: skyblue;
  padding: 2rem;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}

.info-box {
  text-decoration: none;
  background-color: #007bff;
  color: white;
  border-radius: 30%;
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  cursor: pointer;
  margin: 0;
  padding: 0;

}
@keyframes rotate {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}
.info-box:hover {
  background-color: #0056b3;
  animation: rotate 0.5s ease-in-out;
}
.row {
  width: 100%;
  display: flex;
  justify-content: center;
}

.col {
  max-width: 800px;
  width: 100%;
}

.card {
  background-color: #ffffff;
  border-radius: 15px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  padding: 2rem;
}

.card-body {
  padding: 2rem;
}

.mb-3 {
  margin-bottom: 1rem;
    font-size: 1em;
  }
.d-flex {
  display: flex;
}
.align-items-center {
  align-items: center;
}

.form {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 1rem;
}

.form-outline {
  flex: 1;
  margin-right: 1rem;
}

.form-control {
  font-size: 1em;
  width: 100%;
  padding: 0.75rem;
  border-radius: 10px;
  border: 1px solid #ced4da;
}

.btn {
  font-size: 1em;
  padding: 0.75rem 1.5rem;
  margin: 0;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: background-color 0.5s ease;
  width:max-content;
}

.btn-primary {
  background-color: #007bff;
  color: #ffffff;
}
.btn-edit {
  margin-inline: 0.5rem;
}

.btn-primary:hover {
  background-color: #0056b3;
}

.btn-danger {
  background-color: #dc3545;
  color: #ffffff;
}

.btn-danger:hover {
  background-color: #c82333;
}

.nav-tabs {
  display: flex;
  justify-content: space-around;
  margin-bottom: 1rem;
  border-bottom: 1px solid #dee2e6;
  padding-bottom: 1rem;
}

.nav-item {
  list-style: none;
}

.nav-link {
  padding: 0.5rem 1rem;
  cursor: pointer;
  color: #007bff;
  text-decoration: none;
  transition: color 0.5s ease, background-color 0.5s ease;
  border-radius: 10px;
}

.nav-link:hover {
  color: #0056b3;
  
}

.nav-link.active {
  color: #ffffff;
  background-color: #007bff;
  border-radius: 10px;
}

.tab-content {
  margin-top: 1rem;
}

.tab-pane {
  display: none;
}

.tab-pane.show {
  display: block;
}

.list-group {
  list-style: none;
  padding: 0;
  margin: 0;
}

.list-group-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.75rem 1rem;
  border: 1px solid #ced4da;
  border-radius: 10px;
  margin-bottom: 0.5rem;
  transition: background-color 0.3s ease
}

.list-group-item:hover {
  background-color: #f1f1f1;
}

.form-check-input {
  margin-right: 0.5rem;
}

.text-decoration-line-through {
  text-decoration: line-through;
  color: #6c757d;
}

</style>