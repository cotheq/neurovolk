var request = require("request"), fs = require("fs");

const
    ACCESS_TOKEN = 
        //"2e79a40af687204d19f4ac1d1633c9b8b468c19fcde13fcf9abc1239b07457d90cd5c70030f761ecc2846"
        //"74e563fc1f005f498ab264b2b4a21b95112157c928c8f0ac2db2c1878d7045e0134394d289ce434c053ce"
        "3fc7270468f53f407e05f0e50c80312851bdf00b8d2e54c5e362fc06be169a5fcba06b902f4b0a98726fb"
    ;
    //group_id = "33339790";
    //group_id = "44852241";
    //group_id = "38128215";
    //group_id = "36794006";
    group_id = "61744518";
    //group_id = "46987089";

    count = 100;

function wallGet(offset) {
    let filename = "club" + group_id + ".txt";
    if (offset == 0) {
        fs.writeFileSync(filename, "");
    }
    let url = "https://api.vk.com/method/wall.get?owner_id=-" + group_id + "&count=" + count + "&offset=" + offset + "&filter=owner&extended=1&v=5.103&access_token=" + ACCESS_TOKEN;
    request(url, function(error, response, body) {
        console.log("Parsing wall of club" + group_id + " with offset " + offset + "...");
        if (!error) {
            let r = JSON.parse(response.body).response;
            let n = r.items.length;
            if (n) {
                for (let i = 0; i < n; i++) {
                    let text = r.items[i].text.trim();
                    //console.log(text);
                    if (text != "") {
                        fs.appendFileSync(filename, "^" + text);
                    } else {
                        console.log("fuck");
                    }                 
                }
                console.log("offset " + offset + " saved");
                wallGet(offset + 100);
            } else {
                console.log("Done!");
                return;
            }           
        } else {
            console.log("error: " + error);
            console.log("Trying again....");
            wallGet(offset);
        }
    });
}

function main() {
    wallGet(28900);
}


main();