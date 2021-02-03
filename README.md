# BingApi
Bing必应壁纸PHP单文件实现的API

## 参数  
- ```day``` 时间，0是今天，1是前1天，2是前2天，最多前7天。默认今天。  
- ```type``` ```pic```,```url```,```text``` 分别是直接跳转图像链接，展示链接，展示图片描述（版权）  
- ```size``` 图片大小，```2k```,```1920```,```1080```，分别是2K(也可能4k)，1920x1080，1080x1920  
- ```resolution``` 具体的分辨率，会覆盖```size```参数，具体的分辨率，已知有以下这些  
```
#横屏
1920x1200
1920x1080
1366x768
1280x768
1024x768
800x600
800x480
#竖屏
1080x1920
768x1366
768x1280
720x1280
640x480
480x800
400x240
320x240
240x320
#正方形(可以作为头像之类的)
320x320
240x240
```

## 示例  
```
#无参数，直接跳转今天1920x1080图片
https://haoduck.com/demo/bing/index.php
#直接跳转今天1080x1920图片
https://haoduck.com/demo/bing/index.php?size=1080
#只展示链接
https://haoduck.com/demo/bing/index.php?type=url
https://haoduck.com/demo/bing/index.php?size=1080&type=url
#展示描述
https://haoduck.com/demo/bing/index.php?type=text
https://haoduck.com/demo/bing/index.php?size=1080&type=text
#指定具体的分辨率
https://haoduck.com/demo/bing/index.php?resolution=1920x1200
https://haoduck.com/demo/bing/index.php?resolution=320x320
```

不懂PHP，一边百度一边写的。代码可读性可能不怎么好。  

