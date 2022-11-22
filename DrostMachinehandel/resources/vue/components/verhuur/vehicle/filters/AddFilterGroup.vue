<script>

export default {
    data() {
        return {
            filterName: "",
            filterOptions: [
                {
                    name: ""
                }
            ]
        }
    },

    methods: {
        _handleAddFilterClick() {

        }
    }
}

</script>

<template>
        <div class="absolute w-screen h-screen add-filter-group-vue top-0 left-0">
            <div class="add-filter-menu">
                <div class="head">
                    <h1>Filter toevoegen</h1>
                </div>
                <div class="body">
                    <div class="filter-name">
                        <label for="filter-name" class="filter-name-label">Naam:</label>
                        <input type="text" id="filter-name" v-model="filterName" class="filter-name-input">
                    </div>
                    <div class="filter-options">
                        <div class="title">
                            <h2>Filter opties:</h2>
                            <div class="add-filter" @click="_handleAddFilterClick">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                        <div class="list-filter-options">
                            <div class="option">
                                <div class="name">
                                    <p>Naam:</p>
                                </div>
                                <div class="value">
                                    <input class="filter-value" value="test"/>
                                    <div class="removeButton">
                                        <i class="fas fa-trash text-lg remove-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="option">
                                <div class="name">
                                    <p>Naam:</p>
                                </div>
                                <div class="value">
                                    <input class="filter-value" value="test"/>
                                    <div class="removeButton">
                                        <i class="fas fa-trash text-lg remove-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="option">
                                <div class="name">
                                    <p>Naam:</p>
                                </div>
                                <div class="value">
                                    <input class="filter-value" value="test"/>
                                    <div class="removeButton">
                                        <i class="fas fa-trash text-lg remove-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="option">
                                <div class="name">
                                    <p>Naam:</p>
                                </div>
                                <div class="value">
                                    <input class="filter-value" value="test"/>
                                    <div class="removeButton">
                                        <i class="fas fa-trash text-lg remove-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="option">
                                <div class="name">
                                    <p>Naam:</p>
                                </div>
                                <div class="value">
                                    <input class="filter-value" value="test"/>
                                    <div class="removeButton">
                                        <i class="fas fa-trash text-lg remove-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="option">
                                <div class="name">
                                    <p>Naam:</p>
                                </div>
                                <div class="value">
                                    <input class="filter-value" value="test"/>
                                    <div class="removeButton">
                                        <i class="fas fa-trash text-lg remove-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>