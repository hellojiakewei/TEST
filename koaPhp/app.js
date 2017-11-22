import Koa from "koa";
import router from "koa-simple-router";
import initController from "./controller/initController";
import babel_co from "babel-register";
import babel_po from "babel-polyfill";
import CONFIG from "./config/config";
import render from "koa-swig";
import co from "co";
import serve from "koa-static";
const app = new Koa();

app.context.render = co.wrap(render({
  root: CONFIG.get('viewDir'),
  autoescape: true,
  cache: 'memory', // disable, set to false 
  ext: 'html'
}));

initController.init(app,router);
app.use(serve(CONFIG.get('staticDir')));
app.listen(CONFIG.get('port'));
export default app;