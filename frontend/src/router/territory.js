export default {
  path: "/territories",
  name: "territories",
  component: () => import("../components/territory/Layout"),
  redirect: { name: "TerritoryList" },
  children: [
    {
      name: "TerritoryList",
      path: "",
      component: () => import("../views/territory/List"),
    },
    {
      name: "TerritoryCreate",
      path: "new",
      component: () => import("../views/territory/Create"),
    },
    {
      name: "TerritoryUpdate",
      path: ":id/edit",
      component: () => import("../views/territory/Update"),
    },
    {
      name: "TerritoryShow",
      path: ":id",
      component: () => import("../views/territory/Show"),
    },
  ],
};
