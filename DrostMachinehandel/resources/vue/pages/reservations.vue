<script>

export default {
    data() {
        return {
            requests: [],
            pages: [],
            maxPages: [],
            searchQuery: [],
        }
    },

    methods: {
        fetchRequests() {
            
        }
    }
}

</script>


<template>
    <div class="vue-reservations">
            <div class="table">
                <div class="dealer-table-header">
                    <div class="actions">
                        <div class="col-left">
                            <div class="filter-on-name">
                                <div class="input">
                                    <input v-model="searchKey" type="text" class="searcher" placeholder="Zoeken...">
                                    <i class="fas fa-search search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-info">
                        <div class="item name">
                            <p>Naam</p>
                        </div>
                        <div class="item email">
                            <p>E-mailadres</p>
                        </div>
                        <div class="item phonenumber">
                            <p>Telefoonnummer</p>
                        </div>
                        <div class="item companyname">
                            <p>Bedrijfsnaam</p>
                        </div>
                        <div class="item kvknumber">
                            <p>KVK nummer</p>
                        </div>
                        <div class="item status">
                            <p>Status</p>
                        </div>
                        <div class="item actions">
                            <p>Acties</p>
                        </div>
                    </div>
                </div>
                <div class="table-body">
                    <dm-dealer v-for="dealer in getDealers" :key="dealer.id" :dealer="dealer"></dm-dealer>
                </div>
                <div class="table-footer">
                    <div class="pager">
                        <div @click="_handlePagerClick(1)" v-if="(page !== 1)" class="pager-item">
                            <i class="pager-counter fas fa-angle-double-left"></i>
                        </div>
                        <div class="pager-item" :class="[ this.page == page ? 'active' : 'inactive' ]" :key="index"
                            v-for="page, index in getPager">
                            <div class="pager-counter" @click="_handlePagerClick(page)">{{ page }}</div>
                        </div>
                        <div @click="_handlePagerClick(getPages)" v-if="(page !== getPages)" class="pager-item">
                            <i class="pager-counter fas fa-angle-double-right"></i>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>