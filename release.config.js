const config = {
    branches: [
        // Pre-releases for v1 (continue using 'alpha' from previous tags)
        'v1', { name: 'v1-dev', prerelease: 'alpha.28' },
        'v2', { name: 'v2-dev', prerelease: 'v2.alpha' },
    ],
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