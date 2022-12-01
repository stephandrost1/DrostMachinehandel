<script>

export default {
    props: ["title"]
}

</script>

<template>
    <div class="dialog-vue">
        <div class="modal">
            <div class="header">
                <div class="modal-title"><p>{{ title }}</p></div>
            </div>
        </div>
    </div>
</template>