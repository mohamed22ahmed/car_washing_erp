import { mapGetters } from 'vuex'
export default {
    props: ['userPermission'],

    data() {
        return {}
    },

    methods: {
        can(key) {
            let isPermitted = false;
            for (let d of this.userPermission2) {
                if (this.$route.name == d.screen_route) {
                    if (d.operation_id == key) {
                        isPermitted = true
                        break;
                    }
                }
            }
            return isPermitted
        },
    },

    computed: {
        ...mapGetters({
            'userPermission2': 'getUserPermission'
        }),
        cannew() {
            return this.can('1') //new
        },
        canupdate() {
            return this.can('2') //update
        },
        candelete() {
            return this.can('3') //delete
        },
        canpost() {
            return this.can('4') //post
        },
        canunpost() {
            return this.can('5') //unpost
        },
        cancalculate() {
            return this.can('6') //calculate
        },
        canprint() {
            return this.can('7') //print
        },
        candisplay() {
            return this.can('8') //display
        },
        canrelease() {
            return this.can('9') //release
        },
        canupload() {
            return this.can('10') //upload
        },
        canaccess() {
            return this.can('11') //access
        },
        cangenerate() {
            return this.can('12') //generate
        },
    }
}
