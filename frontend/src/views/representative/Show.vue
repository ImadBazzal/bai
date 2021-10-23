<template>
    <div>
        <Toolbar :handle-edit="editHandler" :handle-delete="del">
            <template slot="left">
                <v-toolbar-title v-if="item">{{
                        `${$options.servicePrefix} ${item['@id']}`
                    }}
                </v-toolbar-title>
            </template>
        </Toolbar>

        <br/>

        <div v-if="item" class="table-representative-show">
            <v-simple-table>
                <template slot="default">
                    <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>

                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><strong>{{ $t('name') }}</strong></td>
                        <td>
                            {{ item['name'] }}
                        </td>

                        <td><strong>{{ $t('company') }}</strong></td>
                        <td>
                            {{ item['company'] }}
                        </td>
                    </tr>

                    <tr>
                        <td><strong>{{ $t('emails') }}</strong></td>
                        <td>
                            <ul>
                                <li v-for="_item in item['emails']" :key="_item['@id']">
                                    {{ _item['email'] }}
                                </li>
                            </ul>
                        </td>

                    </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </div>

        <Loading :visible="isLoading"/>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import {mapFields} from 'vuex-map-fields';
import Loading from '../../components/Loading';
import ShowMixin from '../../mixins/ShowMixin';
import Toolbar from '../../components/Toolbar';

const servicePrefix = 'Representative';

export default {
    name: 'RepresentativeShow',
    servicePrefix,
    components: {
        Loading,
        Toolbar
    },
    mixins: [ShowMixin],
    computed: {
        ...mapFields('representative', {
            isLoading: 'isLoading'
        }),
        ...mapGetters('representative', ['find'])
    },
    methods: {
        ...mapActions('representative', {
            deleteItem: 'del',
            reset: 'resetShow',
            retrieve: 'load'
        })
    }
};
</script>
