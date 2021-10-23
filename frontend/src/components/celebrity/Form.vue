<template>
    <v-form>
        <v-container fluid>
            <v-row>
                <v-col cols="12" sm="6" md="6">
                    <v-text-field
                        v-model="item.name"
                        :error-messages="nameErrors"
                        :label="$t('name')"
                        required
                        @input="$v.item.name.$touch()"
                        @blur="$v.item.name.$touch()"
                    />
                </v-col>

                <v-col cols="12" sm="6" md="6">
                    <InputDate
                        v-model="item.birthday"
                        :label="$t('birthday')"
                        :error-messages="birthdayErrors"
                        required
                    />
                </v-col>

            </v-row>

            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <v-text-field
                        v-model="item.bio"
                        :error-messages="bioErrors"
                        :label="$t('bio')"
                        required
                        @input="$v.item.bio.$touch()"
                        @blur="$v.item.bio.$touch()"
                    />
                </v-col>
            </v-row>

            <div v-if="item['@id']">
                <v-row>

                    <v-col cols="12" sm="12" md="12">
                        <h4>Agents:</h4>

                        <ul>
                            <li v-for="_item in item['agents']" :key="_item['@id']">
                                {{ _item['representative']['name'] }}
                                <span v-if="_item['territory']">({{ _item['territory']['name'] }})</span>

                                <v-icon class="ml-4" @click="doDeleteAgent(_item)" color="red">mdi-delete</v-icon>
                            </li>
                        </ul>

                        <h5 class="mt-5">Add</h5>

                        <div>
                            <v-select
                                label="Select representative"
                                item-value="@id"
                                item-text="name"
                                v-model="newAgent.representative"
                                :items="representativeSelectItems || []"></v-select>

                            <v-select
                                label="Select territory"
                                item-value="@id"
                                item-text="name"
                                v-model="newAgent.territory"
                                :items="territorySelectItems || []"></v-select>

                            <v-btn color="primary" :disabled="!newAgent.representative" @click="doCreateAgent(newAgent)">Add</v-btn>
                        </div>

                    </v-col>

                </v-row>

                <v-row>

                    <v-col cols="12" sm="12" md="12">
                        <h4>Publicists</h4>

                        <ul>
                            <li v-for="_item in item['publicists']" :key="_item['@id']">
                                {{ _item['representative']['name'] }}
                                <span v-if="_item['territory']">({{ _item['territory']['name'] }})</span>
                                <v-icon class="ml-4" @click="doDeletePublicist(_item)" color="red">mdi-delete</v-icon>
                            </li>
                        </ul>

                        <h5 class="mt-5">Add</h5>

                        <div>
                            <v-select
                                label="Select representative"
                                item-value="@id"
                                item-text="name"
                                v-model="newPublicist.representative"
                                :items="representativeSelectItems || []"></v-select>

                            <v-select
                                label="Select territory"
                                item-value="@id"
                                item-text="name"
                                v-model="newPublicist.territory"
                                :items="territorySelectItems || []"></v-select>

                            <v-btn color="primary" :disabled="!newPublicist.representative" @click="doCreatePublicist(newPublicist)">Add</v-btn>
                        </div>
                    </v-col>
                </v-row>

                <v-row>

                    <v-col cols="12" sm="12" md="12">
                        <h4>Managers</h4>

                        <ul>
                            <li v-for="_item in item['managers']" :key="_item['@id']">
                                {{ _item['representative']['name'] }}
                                <span v-if="_item['territory']">({{ _item['territory']['name'] }})</span>
                                <v-icon class="ml-4" @click="doDeleteManager(_item)" color="red">mdi-delete</v-icon>
                            </li>
                        </ul>

                        <h5 class="mt-5">Add</h5>

                        <div>
                            <v-select
                                label="Select representative"
                                item-value="@id"
                                item-text="name"
                                v-model="newManager.representative"
                                :items="representativeSelectItems || []"></v-select>

                            <v-select
                                label="Select territory"
                                item-value="@id"
                                item-text="name"
                                v-model="newManager.territory"
                                :items="territorySelectItems || []"></v-select>

                            <v-btn color="primary" :disabled="!newManager.representative" @click="doCreateManager(newManager)">Add</v-btn>
                        </div>
                    </v-col>
                </v-row>
            </div>



        </v-container>
    </v-form>
</template>

<script>
import has from 'lodash/has';
import {validationMixin} from 'vuelidate';
import {required} from 'vuelidate/lib/validators';
import InputDate from '../InputDate';
import {date} from '../../validators/date';
import {mapFields} from "vuex-map-fields";
import {mapActions} from "vuex";

export default {
    name: 'CelebrityForm',
    mixins: [validationMixin],
    components: {
        InputDate,
    },
    props: {
        values: {
            type: Object,
            required: true
        },
        errors: {
            type: Object,
            default: () => {
            }
        },
        initialValues: {
            type: Object,
            default: () => {
            }
        }
    },
    mounted() {
        this.representativeGetSelectItems();
        this.territoryGetSelectItems();
    },
    data() {
        return {
            name: null,
            birthday: null,
            bio: null,
            newAgent: {
                representative: null,
                territory: null,
            },
            newManager: {
                representative: null,
                territory: null,
            },
            newPublicist: {
                representative: null,
                territory: null,
            }
        };
    },
    computed: {
        ...mapFields('representative', {
            representativeSelectItems: 'selectItems'
        }),
        ...mapFields('territory', {
            territorySelectItems: 'selectItems'
        }),
        // eslint-disable-next-line
        item() {
            return this.initialValues || this.values;
        },
        nameErrors() {
            const errors = [];

            if (!this.$v.item.name.$dirty) return errors;

            has(this.violations, 'name') && errors.push(this.violations.name);

            !this.$v.item.name.required && errors.push(this.$t('Field is required'));

            return errors;
        },
        birthdayErrors() {
            const errors = [];

            if (!this.$v.item.birthday.$dirty) return errors;

            has(this.violations, 'birthday') && errors.push(this.violations.birthday);

            !this.$v.item.birthday.required && errors.push(this.$t('Field is required'));

            return errors;
        },
        bioErrors() {
            const errors = [];

            if (!this.$v.item.bio.$dirty) return errors;

            has(this.violations, 'bio') && errors.push(this.violations.bio);

            !this.$v.item.bio.required && errors.push(this.$t('Field is required'));

            return errors;
        },
        violations() {
            return this.errors || {};
        },

    },
    watch: {},
    methods: {
        ...mapActions({
            representativeGetSelectItems: 'representative/fetchSelectItems'
        }),
        ...mapActions({
            territoryGetSelectItems: 'territory/fetchSelectItems'
        }),
        ...mapActions({
            createAgent: 'agent/create',
            deleteAgent: 'agent/del',
            createPublicist: 'publicist/create',
            deletePublicist: 'publicist/del',
            createManager: 'manager/create',
            deleteManager: 'manager/del',
            loadCelebrity: 'celebrity/load',
        }),
        async doCreateAgent(data) {
            data['celebrity'] = this.item['@id'];

            await this.createAgent(data)

            this.newAgent.representative = null;
            this.newAgent.territory = null;

            this.loadCelebrity(this.item['@id'])
        },
        async doDeleteAgent(item) {
            await this.deleteAgent(item)

            this.loadCelebrity(this.item['@id'])
        },
        async doCreatePublicist(data) {
            data['celebrity'] = this.item['@id'];

            await this.createPublicist(data);

            this.newPublicist.representative = null;
            this.newPublicist.territory = null;

            this.loadCelebrity(this.item['@id'])
        },
        async doDeletePublicist(item) {
            await this.deletePublicist(item);

            this.loadCelebrity(this.item['@id'])
        },
        async doCreateManager(data) {
            data['celebrity'] = this.item['@id'];

            await this.createManager(data)

            this.newManager.representative = null;
            this.newManager.territory = null;

            this.loadCelebrity(this.item['@id'])
        },
        async doDeleteManager(item) {
            await this.deleteManager(item)

            this.loadCelebrity(this.item['@id'])
        },
    },
    validations: {
        item: {
            name: {
                required,
            },
            birthday: {
                required,
                date,
            },
            bio: {
                required,
            },
        }
    }
};
</script>
