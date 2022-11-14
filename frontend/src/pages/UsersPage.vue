<template>
  <q-page padding>
    <h3 class="text-h3">Menage users</h3>
    <div class="q-pa-md">
      <q-table
        title="Treats"
        :rows="store.usersData"
        :columns="columns"
        row-key="name"
      >
        <template v-slot:body-cell-actions="props">
          <q-td :props="props">
            <q-btn icon="mode_edit" @click="onEdit(props.row)"></q-btn>
            <q-btn icon="delete" @click="onDelete(props.row)"></q-btn>
          </q-td>
        </template>
      </q-table>
    </div>

    <q-dialog v-model="dialog">
      <q-card style="width: 300px">
        <q-card-section>
          <p v-html="dialog_info"></p>
        </q-card-section>

        <q-card-actions align="right" class="bg-white text-teal">
          <q-btn v-close-popup flat label="OK"/>
        </q-card-actions>
      </q-card>
    </q-dialog>

  </q-page>
</template>

<script>
import { useQuasar } from 'quasar';
import { useAuthStore } from "src/stores/user";

const columns = [
  { name: 'fullName', required: true, label: 'Full name', align: 'left', field: 'fullName', sortable: true},
  { name: 'email', align: 'center', label: 'Email', field: 'email', sortable: true },
  { name: 'dateOfBirth', label: 'Date Of Birth', field: 'dateOfBirth', sortable: true },
  { name: 'actions', label: 'Actions', field: '' }
]

export default {

  setup(){
    const $q = useQuasar()
    const store = useAuthStore();
    let dialog = false;
    let dialog_info = '';

    $q.loading.show({
      message: 'Users loading. Please wait...',
      boxClass: 'bg-grey-2 text-grey-9',
      spinnerColor: 'primary'
    })

    store.users().then(() => {

    }).catch(error => {
      dialog = true;
      dialog_info = error.toString();
    });

    $q.loading.hide();

    return{
      store,
      columns,
      dialog: false,
      dialog_info: ''
    }
  },

  methods:  {
    onEdit(props){
      console.log(props.id);
    },
    onDelete(props){
      console.log(props.id);
    }
  }
}
</script>
