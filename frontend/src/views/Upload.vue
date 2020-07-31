<template>
  <div class="home">
    <v-container>
      <v-row style="justify-content: center;">
        <v-col cols="6">
          <v-text-field
            label="name"
            type="text"
            v-model="formData.name"
            filled
            dense
            rounded
          />
          <v-text-field
            label="description"
            type="text"
            v-model="formData.description"
            filled
            dense
            rounded
          />
          <v-file-input
            label="image"
            type="file"
            name="image"
            @change="fileSelected"
            filled
            dense
            rounded
          />
          <select name="type" v-model="formData.type" id="">
            <option value="patent">專利</option>
          </select>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>

export default {
  name: 'Upload',
  data() {
    return {
      formData: {
        name: '',
        description: '',
        image: undefined,
      },
    };
  },
  methods: {
    fileSelected(e) {
      const image = e.target.files;
      if (image.length === 0) return;
      [this.image] = e.target.files;

      // https://vuetifyjs.com/en/components/grids/
      // https://hkchen.tech/posts/2019/02/26/drag-file-in-vue-with-java.html
    },
  },
};
</script>
