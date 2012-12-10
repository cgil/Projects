new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 8,
  interval: 30000,
  width: 276,
  height: 605,
  theme: {
    shell: {
      background: '#2d2d2d',
      color: '#ffffff'
    },
    tweets: {
      background: '#000000',
      color: '#ffffff',
      links: '#059bbc'
    }
  },
  features: {
    scrollbar: true,
    loop: false,
    live: true,
    behavior: 'all'
  }
}).render().setUser('eatmeme1').start();