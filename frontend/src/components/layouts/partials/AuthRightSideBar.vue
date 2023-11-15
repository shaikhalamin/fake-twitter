<template>
  <b-row>
    <b-col>
      <b-row class="mt-2">
        <b-col>
          <b-input-group>
            <template #prepend>
              <b-input-group-text class="">
                <span>
                  <b-icon icon="search" scale="0.8" variant="info"></b-icon
                ></span>
              </b-input-group-text>
            </template>
            <b-form-input class=""></b-form-input>
          </b-input-group>
        </b-col>
      </b-row>
    </b-col>
  </b-row>
</template>

<script>
export default {
  name: 'AuthRightSideBar',
  props: ['tokenUser'],
  components: {}
}
</script>
