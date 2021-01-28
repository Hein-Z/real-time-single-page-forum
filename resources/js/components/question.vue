<template>
    <div class="col-12 col-md-6 mt-3">
        <v-card
            :color="backgroundColor"
            dark
        >
            <v-card-title>
                <div class="flex flex-row">
                    <div class="title font-weight-light">{{ title }}</div>
                    <div class="h5 badge-dark badge">{{ categoryName }}</div>
                </div>
            </v-card-title>

            <v-card-text class="headline font-weight-bold">
                "{{ body }}"
            </v-card-text>

            <v-card-actions>
                <v-list-item class="grow">
                    <v-list-item-avatar color="grey darken-3">
                        <v-img
                            class="elevation-6"
                            alt=""
                            src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
                        ></v-img>
                    </v-list-item-avatar>

                    <v-list-item-content>
                        <v-list-item-title>{{ userName }}</v-list-item-title>
                    </v-list-item-content>

                    <v-row
                        align="center"
                        justify="end"
                    >
                        <v-icon class="mr-1">
                            mdi-heart
                        </v-icon>
                        <span class="subheading mr-2">256</span>
                    </v-row>
                </v-list-item>
            </v-card-actions>
        </v-card>
    </div>
</template>
<script>
export default {
    props: ['title', 'id', 'body', 'slug', 'createdAt', 'categoryName', 'userName'],
    data: () => ({
        backgroundColor: '#' + (Math.random() * 0xDDDDDD << 0).toString(16),
    }),
}
</script>
