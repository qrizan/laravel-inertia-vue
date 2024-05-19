<script setup lang="ts">
import { ref } from 'vue'
import { RouterLink } from 'vue-router'

import UserOne from '@/assets/images/user/user-01.png'
import UserTwo from '@/assets/images/user/user-02.png'
import UserThree from '@/assets/images/user/user-03.png'
import UserFour from '@/assets/images/user/user-04.png'
import UserFive from '@/assets/images/user/user-05.png'

const chatData = ref([
  {
    avatar: UserOne,
    name: 'Devid Heilo',
    text: 'How are you?',
    textCount: 3,
  },
  {
    avatar: UserTwo,
    name: 'Henry Fisher',
    text: 'Waiting for you!',
    textCount: 0,
  },
  {
    avatar: UserFour,
    name: 'Jhon Doe',
    text: "What's up?",
    textCount: 0,
  },
  {
    avatar: UserFive,
    name: 'Jane Doe',
    text: 'Great',
    textCount: 2,
  },
  {
    avatar: UserOne,
    name: 'Jhon Doe',
    text: 'How are you?',
    textCount: 0,
  }
])
</script>

<template>
  <div
    class="col-span-12 rounded-sm border border-stroke bg-white py-6 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4"
  >
    <h4 class="mb-6 px-7.5 text-xl font-semibold text-black dark:text-white">Chats</h4>

    <div>
      <template v-for="(chat, index) in chatData" :key="index">
        <div
          to="/"
          class="flex items-center gap-5 py-3 px-7.5 hover:bg-gray-3 dark:hover:bg-meta-4"
        >
          <div class="relative h-14 w-14">
            <img :src="chat.avatar" alt="User" />
          </div>

          <div class="flex flex-1 items-center justify-between">
            <div>
              <h5 class="font-medium text-black dark:text-white">{{ chat.name }}</h5>
              <p>
                <span class="text-sm text-black dark:text-white">{{ chat.text }}</span>
              </p>
            </div>
            <div
              v-if="chat.textCount !== 0"
              class="flex h-6 w-6 items-center justify-center rounded-full bg-primary"
            >
              <span class="text-sm font-medium text-white"> {{ chat.textCount }}</span>
            </div>
          </div>
        </div>
      </template>
    </div>
  </div>
</template>
