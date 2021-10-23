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
                    <v-text-field
                        v-model="item.company"
                        :error-messages="companyErrors"
                        :label="$t('company')"
                        required
                        @input="$v.item.company.$touch()"
                        @blur="$v.item.company.$touch()"
                    />
                </v-col>
            </v-row>

            <v-row>
                <v-combobox
                    v-model="emailsRaw"
                    :error-messages="emailsErrors"
                    :label="$t('emails')"
                    required
                    hide-selected
                    chips
                    :hide-no-data="true"
                    deletable-chips
                    multiple
                    :items="emailsRaw"
                    :return-object="true"
                    @input="$v.item.emails.$touch()"
                    @blur="$v.item.emails.$touch()"
                />
            </v-row>

        </v-container>
    </v-form>
</template>

<script>
import has from 'lodash/has';
import {validationMixin} from 'vuelidate';
import {required} from 'vuelidate/lib/validators';

export default {
    name: 'RepresentativeForm',
    mixins: [validationMixin],
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
    },
    data() {
        return {
            name: null,
            company: null,
            emailsRaw: [],
            emails: [],
        };
    },
    watch: {
        emailsRaw(emailsString) {
            this.values.emails = emailsString
                .map(function (email) {
                    return {email}
                })
        }
    },
    computed: {
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
        companyErrors() {
            const errors = [];

            if (!this.$v.item.company.$dirty) return errors;

            has(this.violations, 'company') && errors.push(this.violations.company);

            !this.$v.item.company.required && errors.push(this.$t('Field is required'));

            return errors;
        },
        emailsErrors() {
            const errors = [];

            if (!this.$v.item.emails.$dirty) return errors;

            has(this.violations, 'emails') && errors.push(this.violations.emails);


            return errors;
        },
        violations() {
            return this.errors || {};
        }
    },
    methods: {},
    validations: {
        item: {
            name: {
                required,
            },
            company: {
                required,
            },
            emails: {
                required,
            },
        }
    }
};
</script>
