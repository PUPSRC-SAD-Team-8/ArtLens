const config = {
    branches: [
        { name: 'v1', range: '1.x' },
        // Pre-releases for v1 (continue using 'alpha' from previous tags)
        { name: 'v1-dev', prerelease: 'alpha' },
        { name: 'v2', range: '>=2.0.0' },
        { name: 'v2-dev', prerelease: 'v2.alpha' },
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