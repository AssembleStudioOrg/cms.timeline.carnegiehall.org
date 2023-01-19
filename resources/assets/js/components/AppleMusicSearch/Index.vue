<template>
  <!-- eslint-disable -->
  <div class="apple-music-search">
    <input
      type="search"
      class="form__input form__input--small"
      placeholder="Search US Apple Music Library..."
      v-model="term"
    />
    <select v-model="type" class="form__input form__input--small select__input">
      <option value="songs">Songs</option>
      <option value="music-videos">Music Videos</option>
    </select>

    <div
      v-if="(!loading && songs.length) || musicVideos.length"
      class="results"
    >
      <template v-if="songs.length">
        <div class="title">Songs</div>
        <div v-for="song in songs" class="result">
          <div>
            <img :src="makeThumbnail(song.attributes.artwork.url)" />
          </div>
          <div>
            <p>{{ song.attributes.name }}</p>
            <p><b>Artist:</b> {{ song.attributes.artistName || "(empty)" }}</p>
            <p><b>Album:</b> {{ song.attributes.albumName || "(empty)" }}</p>
            <p>
              <b>Released:</b> {{ song.attributes.releaseDate || "(empty)" }}
            </p>
            <p class="id"># {{ song.id }}</p>
          </div>
        </div>
      </template>

      <template v-if="musicVideos.length">
        <div class="title">Music Videos</div>
        <div v-for="musicVideo in musicVideos" class="result">
          <div>
            <img :src="makeThumbnail(musicVideo.attributes.artwork.url)" />
          </div>
          <div>
            <p>{{ musicVideo.attributes.name }}</p>
            <p>
              <b>Artist:</b> {{ musicVideo.attributes.artistName || "(empty)" }}
            </p>
            <p>
              <b>Album:</b> {{ musicVideo.attributes.albumName || "(empty)" }}
            </p>
            <p>
              <b>Released:</b>
              {{ musicVideo.attributes.releaseDate || "(empty)" }}
            </p>
            <p class="id"># {{ musicVideo.id }}</p>
          </div>
        </div>
      </template>
    </div>
  </div>

  <div v-if="!loading && error">
    Sorry, we couldn't find any results matching your search term.
  </div>
</template>

<style lang="scss" scoped>
.apple-music-search {
  display: flex;
  position: relative;
}

.results {
  position: absolute;
  top: 100%;
  margin-top: 4px;
  width: 100%;
  border-radius: 4px;
  background-color: white;
  padding: 0 13px;
  border: 1px solid #e5e5e5;
  box-shadow: 0 10px 10px rgb(0 0 0 / 50%);
  max-height: 400px;
  overflow: auto;
  z-index: 1;
}

.title {
  font-size: 12px;
  text-transform: uppercase;
  padding: 20px 0 0 0;
  font-weight: 600;
  color: #747474;
}

.result {
  display: flex;
  padding: 13px 0;
  border-bottom: 1px solid #f0f0f0;

  & > :not([hidden]) ~ :not([hidden]) {
    margin-left: 13px;
  }

  &:last-child {
    border-bottom: 0;
  }

  img {
    width: 80px;
    border-radius: 2px;
  }

  p {
    font-size: 11px;
    line-height: 1.4;
    color: #666;
  }

  .id {
    margin-top: 5px;
    font-weight: bold;
  }
}

.select__input {
  width: 150px;
  margin-left: 4px;
}
</style>

<script>
/* eslint-disable */
export default {
  data() {
    return {
      term: "",
      type: "songs",
      loading: false,
      songs: [],
      musicVideos: [],
      error: false,
    };
  },
  watch: {
    term() {
      this.LoadSongData();
    },
    type() {
      this.LoadSongData();
    },
  },
  methods: {
    makeThumbnail(src) {
      return src.replace("{w}", 160).replace("{h}", 160);
    },
    LoadSongData() {
      this.songs = []; // reset the data object no matter what.
      this.musicVideos = []; // reset the data object no matter what.
      if (!window.apple_music_developer_token || !this.term.length) {
        this.songs = [];
        this.musicVideos = [];
        return;
      }
      this.loading = true;
      this.error = false;
      var api = axios.create({
        baseURL: "https://api.music.apple.com",
        headers: {
          Authorization: `Bearer ${window.apple_music_developer_token}`, // Developer token is generated within the config file.
        },
      });
      // https://api.music.apple.com/v1/catalog/us/search?types=songs,albums,artists&term=beach+bunny
      api
        .get(
          `/v1/catalog/us/search?types=${this.type}&term=${this.term}&limit=25`
        )
        .then((response) => {
          this.songs = response.data?.results?.songs?.data || [];
          this.musicVideos = response.data?.results["music-videos"]?.data || [];
          this.loading = false;
        })
        .catch(() => {
          this.loading = false;
          this.error = true;
        });
    },
  },
  mounted() {
    console.log("Apple Music search mounted");
  },
};
</script>
