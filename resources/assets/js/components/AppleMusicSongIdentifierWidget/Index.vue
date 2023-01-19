<template>
  <!-- eslint-disable -->
  <div class="song-finder">
    <div
      v-if="loading || data || error"
      v-bind:data-load="loading ? 'loading' : 'loaded'"
    >
      <div v-if="!loading && data" class="song-finder__inner">
        <div v-if="data.attributes && data.attributes.artwork">
          <img
            v-bind:src="
              data.attributes.artwork.url
                .replace('{w}', '160')
                .replace('{h}', '160')
            "
            class="song-finder__album-art"
            width="80"
          />
        </div>
        <div>
          <div v-if="data.attributes.artistName">
            <b>Artist:</b>
            <span v-text="data.attributes.artistName"></span>
          </div>
          <div v-if="data.attributes.albumName">
            <b>Album:</b>
            <span v-text="data.attributes.albumName"></span>
          </div>
          <div v-if="data.attributes.name">
            <b>Song:</b> <span v-text="data.attributes.name"></span>
          </div>
        </div>
        <div
          v-if="
            data.attributes.previews &&
            data.attributes.previews[0] &&
            data.attributes.previews[0].url
          "
        >
          <audio v-bind:src="data.attributes.previews[0].url" controls />
        </div>
      </div>
      <div v-if="!loading && error" class="song-finder__inner">
        Sorry, we couldn't find a match for that Song ID.
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@import "styles.scss";
</style>

<script>
/* eslint-disable */
export default {
  data() {
    return {
      loading: false,
      songId: null,
      data: null,
      error: false,
    };
  },
  watch: {
    songId() {
      this.LoadSongData();
    },
  },
  methods: {
    LoadSongData() {
      this.data = null; // reset the data object no matter what.

      if (!window.apple_music_developer_token || !this.songId) return;

      this.loading = true;
      this.error = false;

      var api = axios.create({
        baseURL: "https://api.music.apple.com",
        headers: {
          Authorization: `Bearer ${window.apple_music_developer_token}`, // Developer token is generated within the config file.
        },
      });

      api
        .get(`/v1/catalog/us/songs/${this.songId}`)
        .then((response) => {
          this.data = response.data.data[0];
          this.loading = false;
        })
        .catch((response) => {
          this.loading = false;
          this.error = true;
        });
    },
  },
  mounted() {
    console.log("Apple Music song identifier mounted");

    // Get the initial value from the page. If something exists, add it to data model.
    var initialValue = document.getElementsByName("apple_music_song_id")[0]
      .value;

    try {
      var initialPayloadValue = document.getElementsByName(
        "apple_music_payload_as_string"
      )[0].value;

      if (initialPayloadValue) {
        const parsedPayload = JSON.parse(initialPayloadValue);
        this.data = parsedPayload.data[0];
      }
    } catch (error) {
      console.error(
        { error },
        "Error trying to parse apple music payload data"
      );
    }

    if (initialValue && !initialPayloadValue) {
      this.songId = initialValue;
    }

    // On form update, get the value and add it to data model.
    window.vm.$store.subscribe((mutation, state) => {
      if (
        mutation.type === "updateFormField" &&
        mutation.payload.name === "apple_music_song_id"
      ) {
        this.songId = mutation.payload.value;
      }
    });
  },
};
</script>
