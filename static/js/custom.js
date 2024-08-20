// 人生倒计时
function init_life_time() {
    function getAsideLifeTime() {
        /* 当前时间戳 */
        let nowDate = +new Date();
        /* 今天开始时间戳 */
        let todayStartDate = new Date(new Date().toLocaleDateString()).getTime();
        /* 今天已经过去的时间 */
        let todayPassHours = (nowDate - todayStartDate) / 1000 / 60 / 60;
        /* 今天已经过去的时间比 */
        let todayPassHoursPercent = (todayPassHours / 24) * 100;
        $('#dayProgress .title span').html(parseInt(todayPassHours));
        $('#dayProgress .progress .progress-inner').css('width', parseInt(todayPassHoursPercent) + '%');
        $('#dayProgress .progress .progress-percentage').html(parseInt(todayPassHoursPercent) + '%');
        /* 当前周几 */
        let weeks = {
            0: 7,
            1: 1,
            2: 2,
            3: 3,
            4: 4,
            5: 5,
            6: 6
        };
        let weekDay = weeks[new Date().getDay()];
        let weekDayPassPercent = (weekDay / 7) * 100;
        $('#weekProgress .title span').html(weekDay);
        $('#weekProgress .progress .progress-inner').css('width', parseInt(weekDayPassPercent) + '%');
        $('#weekProgress .progress .progress-percentage').html(parseInt(weekDayPassPercent) + '%');
        let year = new Date().getFullYear();
        let date = new Date().getDate();
        let month = new Date().getMonth() + 1;
        let monthAll = new Date(year, month, 0).getDate();
        let monthPassPercent = (date / monthAll) * 100;
        $('#monthProgress .title span').html(date);
        $('#monthProgress .progress .progress-inner').css('width', parseInt(monthPassPercent) + '%');
        $('#monthProgress .progress .progress-percentage').html(parseInt(monthPassPercent) + '%');
        let yearPass = (month / 12) * 100;
        $('#yearProgress .title span').html(month);
        $('#yearProgress .progress .progress-inner').css('width', parseInt(yearPass) + '%');
        $('#yearProgress .progress .progress-percentage').html(parseInt(yearPass) + '%');
    }
    getAsideLifeTime();
    setInterval(() => {
        getAsideLifeTime();
    }, 1000);
}
init_life_time();

//左侧图标多彩
let leftHeader=document.querySelectorAll("span.nav-icon>svg,span.nav-icon>i");
let leftHeaderColorArr=["#ff3300","#ff3399","#54d100","#9900cc","#0033ff","#FF6699","#FF33FF","#ff8100","#33CC00","#FF1493","#8A2BE2","#8B3E2F","#00CC33"];
leftHeader.forEach(
    tag=>{
        tagsColor=leftHeaderColorArr[Math.floor(Math.random()*leftHeaderColorArr.length)];
        tag.style.color=tagsColor
    }
);    
// 右侧彩色标签云
let tags = document.querySelectorAll("#tag_cloud a,#tag_cloud-post a");
let infos = document.querySelectorAll(".badge");
let colorArr = ["#0089ff", "#00c919", "#ff4747", "#c052ff", "#ff8939","#ff1200","#ff3399","#ffde00","#6000ff"];
tags.forEach(tag => {
    tagsColor = colorArr[Math.floor(Math.random() * colorArr.length)];
    tag.style.backgroundColor = tagsColor;
});
infos.forEach(info => {
    infosColor = colorArr[Math.floor(Math.random() * colorArr.length)];
    info.style.backgroundColor = infosColor;
});
function addNumber(a) {
    var length = document.getElementById("comment").value.length;
    if(length> 0){
        document.getElementById("comment").focus()
        document.getElementById("comment").value += '\n' + a + new Date
    }else{
        document.getElementById("comment").focus()
        document.getElementById("comment").value += a + new Date
    }
}
$(function(){
    $("#PageLoading").fadeOut(400);
    $("#body").css('overflow','');
});


