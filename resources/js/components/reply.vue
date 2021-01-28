<template>
    <v-card class="mt-2" >
        <v-card-text class="headline font-weight-bold">
            "{{ reply.body }}"
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
                    <v-list-item-title>{{ reply.user.name === current_user_id ? 'You' : reply.user.name }}
                    </v-list-item-title>
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
</template>
<script>
export default {
    props: ['reply','current_user_id'],
}
</script>
