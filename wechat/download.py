import urllib.request

name = 'icon/icon18_1.png'
# 网络上图片的地址
img_src = 'http://www.htmlsucai.com/demo/2018/07/%e4%bb%bf%e5%be%ae%e4%bf%a1%e7%bd%91%e9%a1%b5%e7%89%88%e8%81%8a%e5%a4%a9%e7%95%8c%e9%9d%a2%e6%a8%a1%e6%9d%bf/images/'+name

# 将远程数据下载到本地，第二个参数就是要保存到本地的文件名


urllib.request.urlretrieve(img_src,'D:/project/wechat/public/static/images/'+name)
