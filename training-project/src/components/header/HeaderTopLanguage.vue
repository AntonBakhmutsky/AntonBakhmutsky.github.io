<template lang="pug">
  .header__language
    .header__language-arrow
    a.header__language-link(
      v-for="item in languages"
      :key="item.lang"
      href="javascript:"
    )
      .header__language-link-image
        img(:src="item.img" alt="")
      .header__language-link-lang {{ item.lang }}
</template>

<script>
export default {
  name: 'HeaderTopLanguage',
  data: () => ({
    languages: [
      { lang: 'eng', img: require('@/assets/img/header/lang/eng.png') },
      { lang: 'рус', img: require('@/assets/img/header/lang/rus.png') },
      { lang: 'каз', img: require('@/assets/img/header/lang/kaz.png') }
    ]
  })
}
</script>
