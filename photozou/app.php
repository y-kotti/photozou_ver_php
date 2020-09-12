<?php

class Photozou
{
    protected $photozou_id; 
    protected $password;
    protected $encode;
    protected $options;
    protected $base_dir;
    
    public function __construct($photozou_id, $password)
    {
        $this->photozou_id = $photozou_id;
        $this->password = $password;
        $this->encode = base64_encode($this->photozou_id . ':' . $this->password);
        $this->options = [
            'http' => [
                'method' => 'GET',
                'header' => 'Authorization: Basic ' . $this->encode,
                'ignore_errors' => true
            ]
        ];

        $now = date('Y-m-d');
        $this->base_dir = 'Picture' . $now;
        
        if (!file_exists($this->base_dir)) {
            mkdir($this->base_dir);
            echo 'フォルダを作成しました';
        }
    }

    public function download_all_images($album_id, $limit)
    {
        $this->download($this->get_all_photos($album_id, $limit));
    }

    private function download($result)
    {
        echo "写真ダウンロード中…";
        foreach($result['info']['photo'] as $photo) {
            $img_url = $photo["original_image_url"];
            $id = $photo["photo_id"];

            $img = file_get_contents($img_url, false, stream_context_create($this->options));
            file_put_contents($this->base_dir . '/' . $id . '.jpg', $img);
        }

        echo 'ダウンロードが終了しました';
    }

    private function get_all_photos($album_id, $limit)
    {
        echo "URL取得中…";
        $url = 'https://api.photozou.jp/rest/photo_album_photo.json';
        $parameter = 'album_id=' . $album_id . '&' . 'limit=' . $limit;
        $query = urldecode($url . '?' . $parameter);

        $result = json_decode(
            file_get_contents(
                $query, false, stream_context_create($this->options)
            ),
            true
        );
        return $result;
    }
}