const config = {
    branches: ['main', { name: 'development', prerelease: 'alpha' }],
    // plugins: [
    //     'semantic-release/commit-analyzer',
    //     'semantic-release/release-notes-generator',
    //     '@semantic-release/npm',
    //     [
    //         "@semantic-release/git", {
    //             "assets": ["dist/*.js", "dist/*js.map"],
    //             "message": "chore(release): ${nextRelease.version} [skip ci]\n\n${nextRelease.notes}"
    //         }
    //     ],
    //     '@semantic-release/github'
    // ]
    "plugins": [
        "@semantic-release/commit-analyzer",
        "@semantic-release/release-notes-generator",
        [
            "@semantic-release/github",
            {
                "assets": ["dist/**"]
            }
        ],
        "@semantic-release/git"
    ],
};

module.exports = config;