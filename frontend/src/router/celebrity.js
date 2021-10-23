export default {
  path: "/celebrities",
  name: "celebrities",
  component: () => import("../components/celebrity/Layout"),
  redirect: { name: "CelebrityList" },
  children: [
    {
      name: "CelebrityList",
      path: "",
      component: () => import("../views/celebrity/List"),
    },
    {
      name: "CelebrityCreate",
      path: "new",
      component: () => import("../views/celebrity/Create"),
    },
    {
      name: "CelebrityUpdate",
      path: ":id/edit",
      component: () => import("../views/celebrity/Update"),
    },
    {
      name: "CelebrityShow",
      path: ":id",
      component: () => import("../views/celebrity/Show"),
    },
  ],
};
