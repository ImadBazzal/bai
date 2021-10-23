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

        <div v-if="item" class="table-celebrity-show">
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

                        <td><strong>{{ $t('birthday') }}</strong></td>
                        <td>
                            {{ formatDateTime(item['birthday'], 'long') }}
                        </td>
                    </tr>

                    <tr>
                        <td><strong>{{ $t('bio') }}</strong></td>
                        <td>
                            {{ item['bio'] }}
                        </td>

                        <td><strong>{{ $t('agents') }}</strong></td>
                        <td>
                            <ul>
                                <li v-for="_item in item['agents']" :key="_item['@id']">
                                    {{ _item['representative']['name'] }}
                                    <span v-if="_item['territory']">({{_item['territory']['name']}})</span>
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>{{ $t('publicists') }}</strong></td>
                        <td>
                            <ul>
                                <li v-for="_item in item['publicists']" :key="_item['@id']">
                                    {{ _item['representative']['name'] }}
                                    <span v-if="_item['territory']">({{_item['territory']['name']}})</span>
                                </li>
                            </ul>
                        </td>

                        <td><strong>{{ $t('managers') }}</strong></td>
                        <td>
                            <ul>
                                <li v-for="_item in item['managers']" :key="_item['@id']">
                                    {{ _item['representative']['name'] }}
                                    <span v-if="_item['territory']">({{_item['territory']['name']}})</span>
                                </li>
                            </ul>
                        </td>
                    </tr>

                    </tbody>
                </template>
            </v-simple-table>

            <h3>logs</h3>

            <ul>
                <li v-for="log in logsList" :key="log['@id']">
                    {{ log.objectId }}
                    {{ log.action }}
                    {{ log.data }}
                </li>
            </ul>
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

const servicePrefix = 'Celebrity';

export default {
    name: 'CelebrityShow',
    servicePrefix,
    components: {
        Loading,
        Toolbar
    },
    mixins: [ShowMixin],
    computed: {
        ...mapFields('celebrity', {
            isLoading: 'isLoading'
        }),
        ...mapGetters('celebrity', ['find']),
        ...mapGetters('log', {
            logsList: 'list'
        })
    },
    methods: {
        ...mapActions('celebrity', {
            deleteItem: 'del',
            reset: 'resetShow',
            retrieve: 'load'
        }),
        ...mapActions('log', {
            retrieveLogs: 'fetchAll'
        })
    },
    watch: {
        item: {
            immediate: true,
            handler: async function(item) {
                if(item) {
                    await this.retrieveLogs({objectId: this.item.id})
                }
            }
        }
    },

};
</script>
