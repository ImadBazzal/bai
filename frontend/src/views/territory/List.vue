<template>
  <div class="territory-list">
    <Toolbar :handle-add="addHandler" />

    <v-container grid-list-xl fluid>
      <v-layout row wrap>
        <v-flex sm12>
          <h1>Territory List</h1>
        </v-flex>
        <v-flex lg12>
          <DataFilter :handle-filter="onSendFilter" :handle-reset="resetFilter">
            <TerritoryFilterForm
              ref="filterForm"
              :values="filters"
              slot="filter"
            />
          </DataFilter>

          <br />

          <v-data-table
            v-model="selected"
            :headers="headers"
            :items="items"
            :items-per-page.sync="options.itemsPerPage"
            :loading="isLoading"
            :loading-text="$t('Loading...')"
            :options.sync="options"
            :server-items-length="totalItems"
            class="elevation-1"
            item-key="@id"
            show-select
            @update:options="onUpdateOptions"
          >

            <ActionCell
              slot="item.action"
              slot-scope="props"
              :handle-show="() => showHandler(props.item)"
              :handle-edit="() => editHandler(props.item)"
              :handle-delete="() => deleteHandler(props.item)"
            ></ActionCell>
          </v-data-table>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import { mapFields } from 'vuex-map-fields';
import ListMixin from '../../mixins/ListMixin';
import ActionCell from '../../components/ActionCell';
import TerritoryFilterForm from '../../components/territory/Filter';
import DataFilter from '../../components/DataFilter';
import Toolbar from '../../components/Toolbar';

export default {
  name: 'TerritoryList',
  servicePrefix: 'Territory',
  mixins: [ListMixin],
  components: {
    Toolbar,
    ActionCell,
    TerritoryFilterForm,
    DataFilter
  },
  data() {
    return {
      headers: [
        { text: 'name', value: 'name' },
        {
          text: 'Actions',
          value: 'action',
          sortable: false
        }
      ],
      selected: []
    };
  },
  computed: {
    ...mapGetters('territory', {
      items: 'list'
    }),
    ...mapFields('territory', {
      deletedItem: 'deleted',
      error: 'error',
      isLoading: 'isLoading',
      resetList: 'resetList',
      totalItems: 'totalItems',
      view: 'view'
    })
  },
  methods: {
    ...mapActions('territory', {
      getPage: 'fetchAll',
      deleteItem: 'del'
    })
  }
};
</script>
