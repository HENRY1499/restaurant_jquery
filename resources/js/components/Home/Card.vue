<template>
    <div class="flex justify-center items-center flex-col ">
        <a :href="rutaLink">
            <img :src="imgDynamic" class="w-1/2 max-h-[20rem] rounded-full" alt="image dynamic">
            <div class="w-full mt-4">
                <h1 class="text-white text-center font-bold uppercase">{{ title }}</h1>
            </div>

        </a>
    </div>
</template>

<script setup>
defineProps({
    imgDynamic: {
        type: String,
        required: false,
        validator: value => ['jpg', 'png'].includes(value)
    },
    title: String,
    rutaLink:String
})

</script>