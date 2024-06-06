<template>
     <ul class="flex flex-col gap-4">
            <li class="border-none hover:text-gray-200 rounded-md hover:bg-gradient-to-tl hover:from-cyan-400 hover:to-cyan-700 duration-150 transition-all p-2">
                <a class="flex flex-row items-center gap-2 text-md uppercase font-bold " href="managment/category">
                    <font-awesome-icon :icon="['fas', 'layer-group']"></font-awesome-icon>
                    <span class="leading-7">Categoria</span>
                </a>
            </li>
            <li class="border-none hover:text-gray-200 rounded-md hover:bg-gradient-to-tl hover:from-cyan-400 hover:to-cyan-700 duration-150 transition-all p-2">
                <a class="flex flex-row items-center gap-2 text-md uppercase font-bold " href="#">
                    <font-awesome-icon :icon="['fas', 'list']"></font-awesome-icon>
                    <span class="leading-7">Menú</span>
                </a>
            </li>
            <li class="border-none hover:text-gray-200 rounded-md hover:bg-gradient-to-tl hover:from-cyan-400 hover:to-cyan-700 duration-150 transition-all p-2">
                <a class="flex flex-row items-center gap-2 text-md uppercase font-bold " href="#">
                    <font-awesome-icon :icon="['fas', 'table']"></font-awesome-icon>
                    <span class="leading-7">Table</span>
                </a>
            </li>
            <li class="border-none hover:text-gray-200 rounded-md hover:bg-gradient-to-tl hover:from-cyan-400 hover:to-cyan-700 duration-150 transition-all p-2">
                <a class="flex flex-row items-center gap-2 text-md uppercase font-bold " href="#">
                    <font-awesome-icon :icon="['fas', 'user']"></font-awesome-icon>
                    <span class="leading-7">User</span>
                </a>
            </li>
        </ul>
</template>
<script setup>
defineProps({
    titleMenu:String
})
</script>