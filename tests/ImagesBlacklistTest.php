<?php
class ImagesBlacklistTest extends TestCaseBase
{
    public function testPlainText()
    {
        $info = $this->getInfo('https://github.com/oscarotero/Embed', [
            'adapter'       => [
                'config'        => [
                    'imagesBlacklist' => [
                        'https://avatars1.githubusercontent.com/u/377873?v=3&s=400',
                    ],
                ],
            ]
        ]);

        $this->assertString('https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif', $info->image);
    }

    public function testPlainUrlMatch()
    {
        $info = $this->getInfo('https://github.com/oscarotero/Embed', [
            'adapter'       => [
                'config'        => [
                    'imagesBlacklist' => [
                        '*.githubusercontent.com*',
                    ],
                ],
            ]
        ]);

        $this->assertString('https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif', $info->image);
    }

    public function testAuthorizedImage()
    {
        $info = $this->getInfo('https://github.com/oscarotero/Embed', [
            'adapter'       => [
                'config'        => [
                    'imagesBlacklist' => [
                        '*/octocat-spinner-*',
                    ],
                ],
            ]
        ]);

        $this->assertString('https://avatars1.githubusercontent.com/u/377873?v=3&s=400', $info->image);
    }
}
