<template>
  <!-- eslint-disable -->
  <div class="video-finder" v-if="videoId || data">
    <div
      v-if="loading || data || error"
      v-bind:data-load="loading ? 'loading' : 'loaded'"
    >
      <div v-if="!loading && data" class="video-finder__inner">
        <div
          v-if="
            data.attributes.previews &&
            data.attributes.previews[0] &&
            data.attributes.previews[0].url
          "
          class="video-finder__video-wrapper"
        >
          <video
            v-bind:src="data.attributes.previews[0].url"
            v-bind:poster="
              data.attributes.artwork.url
                .replace('{w}', '800')
                .replace('{h}', '800')
            "
            width="100%"
            controls
          />
        </div>
        <div>
          <p v-if="data.attributes.artistName">
            <b>Artist:</b>
            <span v-text="data.attributes.artistName"></span>
          </p>
          <p v-if="data.attributes.albumName">
            <b>Album:</b>
            <span v-text="data.attributes.albumName"></span>
          </p>
          <p v-if="data.attributes.name">
            <b>Song:</b> <span v-text="data.attributes.name"></span>
          </p>
        </div>
      </div>
      <div v-if="!loading && error" class="video-finder__inner">
        Sorry, we couldn't find a match for that Video ID.
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
      videoId: null,
      data: null,
      error: false,
    };
  },
  watch: {
    videoId() {
      this.LoadVideoData();
    },
  },
  methods: {
    LoadVideoData() {
      this.data = null; // reset the data object no matter what.

      if (!window.apple_music_developer_token || !this.videoId) return;

      this.loading = true;
      this.error = false;

      var api = axios.create({
        baseURL: "https://api.music.apple.com",
        headers: {
          Authorization: `Bearer ${window.apple_music_developer_token}`, // Developer token is generated within the config file.
        },
      });

      api
        .get(`/v1/catalog/us/music-videos/${this.videoId}`)
        .then((response) => {
          this.data = response.data.data[0];
          this.loading = false;
        })
        .catch(() => {
          this.loading = false;
          this.error = true;
        });
    },
  },
  mounted() {
    console.log("Apple Music video identifier mounted");

    // Get the initial value from the page. If something exists, add it to data model.
    var initialValue = document.getElementsByName("apple_music_video_id")[0]
      .value;

    try {
      var initialPayloadValue = document.getElementsByName(
        "apple_music_video_payload_as_string"
      )[0].value;

      if (initialPayloadValue) {
        const parsedPayload = JSON.parse(initialPayloadValue);
        this.data = parsedPayload.data[0];
      }
    } catch (error) {
      console.error(
        { error },
        "Error trying to parse apple music video payload data"
      );
    }

    if (initialValue && !initialPayloadValue) {
      this.videoId = initialValue;
    }

    // On form update, get the value and add it to data model.
    window.vm.$store.subscribe((mutation, state) => {
      if (
        mutation.type === "updateFormField" &&
        mutation.payload.name === "apple_music_video_id"
      ) {
        this.videoId = mutation.payload.value;
      }
    });
  },
};
</script>
