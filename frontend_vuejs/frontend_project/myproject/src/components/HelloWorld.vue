<template>
  <div class="hello">
    <!-- <h1>{{ data1 }}</h1> -->
    <Button type="error" @click="customContent()">新增任務</Button>

    <Table stripe :columns="columns1" :data="data1"></Table>
  </div>
</template>



<script>
const axios = require("axios");
const _ = require("lodash");
export default {
  name: "HelloWorld",

  data() {
    return {
      //data1: 'bbb',
      msg: "Welcome",

      columns1: [
        {
          title: "ID",
          key: "id"
        },
        {
          title: "user_id",
          key: "user_id"
        },
        {
          title: "Name",
          key: "user_name"
        },
        {
          title: "JOB",
          key: "job"
        },
        {
          title: "是否完成",
          key: "doneCh"
        },
        {
          title: "完成任務",
          key: "done",
          width: 150,
          align: "center",
          render: (h, params) => {
            return h("div", [
              h(
                "Button",
                {
                  props: {
                    type: "primary",
                    size: "small"
                  },
                  style: {
                    marginRight: "5px"
                  },
                  on: {
                    click: () => {
                      console.log(params.row);
                      this.changeTodo(params.row);
                    }
                  }
                },
                "做完"
              )
            ]);
          }
        },
        {
          title: "刪除任務",
          key: "delete",
          width: 150,
          align: "center",
          render: (h, params) => {
            return h("div", [
              h(
                "Button",
                {
                  props: {
                    type: "primary",
                    size: "small"
                  },
                  style: {
                    marginRight: "5px"
                  },
                  on: {
                    click: () => {
                      this.deleteJob(params.row);
                    }
                  }
                },
                "刪除"
              )
            ]);
          }
        }
      ],
      data1: [],
      value: {
        done: 0
      },
      url: "http://xxx.xxx.xxx"
    };
  },
  methods: {
    async changeTodo(par) {
      let changeDone = await axios.put(this.url + "/ToDoList", {
        id: par.id
      });
      //已完成的防呆未做
      window.location.reload();
    },
    async deleteJob(par) {
      axios
        .delete(this.url + "/ToDoList", {
          data: {
            id: par.id
          }
        })
        .then(res => {
          console.log(res);
          window.location.reload();
        })
        .catch(err => {
          console.log(err);
        });
      console.log(par.id);
    },
    addUser() {},

  

    async customContent() {
      //let arr_opt = ['Peter', 'Hank', 'Nick'];
      this.$Modal.confirm({
        onOk: async () => {
          console.log("submit");
          axios
            .post(this.url + "/ToDoList", {


              user_id: this.value.user_id,
              user_name: this.value.user_name,
              job: this.value.job,
              done: "0"
            })
            .then(result => {
              alert("新增成功!");
              window.location.reload();
              console.log(result);
            })
            .catch(err => {
              alert("好像哪裡怪怪的!");
              console.log(err);
            });
        },
        onCancel: () => {
          console.log("Cancel");
          this.value = {};
        },
        render: h => {
          return h("div", [
            h("h2", "新增任務"),
            h(
              "Select",
              {
                props: {
                  placeholder: "Select",
                  size: "small"
                },
                on: {
                  "on-change": val => {
                    console.log(val);
                    let arrayUsers = _.keyBy(this.users, "id");
                    this.value.user_name = arrayUsers[val].name;
                    this.value.user_id = val;
                  }
                }
              },
              _.map(this.users, function(obj) {
                console.log(obj);
                return h(
                  "Option",
                  {
                    props: { value: obj.id }
                  },
                  obj.name
                );
              })
            ),

            h("Input", {
              props: {
                autofocus: true,
                placeholder: "Please enter your job..."
              },
              on: {
                input: val => {
                  console.log(val);
                  this.value.job = val;
                }
              }
            })
          ]);
        }
      });
    }
  },

  beforeCreate: async function() {
    this.url = "http://xxx.xxx.xxx";

    let test = await axios.get(this.url + "/ToDoList/hello");
    let users = await axios.get(this.url + "/ToDoList/Users");

    //this.data1 = test.data;
    _.map(test.data, val => {
      if (val.done == 0) {
        val.doneCh = "未完成";
      } else {
        val.doneCh = "完成";
      }
    });
    this.data1 = test.data;
    this.users = users.data;
    console.log(users);
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1,
h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
