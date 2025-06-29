# 貔貅发卡 (pxiuka)

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <strong>一个现代、强大、高效的自动化虚拟商品销售平台</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel 12">
  <img src="https://img.shields.io/badge/Livewire-3.x-4d2b78?style=for-the-badge" alt="Livewire 3">
  <img src="https://img.shields.io/badge/Filament-3.x-f59e0b?style=for-the-badge" alt="Filament 3">
  <img src="https://img.shields.io/badge/PostgreSQL-16-336791?style=for-the-badge&logo=postgresql" alt="PostgreSQL">
  <img src="https://img.shields.io/badge/MaryUI-1.x-f43f5e?style=for-the-badge" alt="MaryUI">
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss" alt="Tailwind CSS">
</p>

---

## 📖 项目简介

**貔貅发卡 (pxiuka)** 项目旨在利用当今 Laravel 生态中最前沿、最高效的技术栈，打造一个性能卓越、界面美观、开发体验一流的现代化自动售货（发卡）解决方案。

我们抛弃了传统的后台构建方式和前端模板，全面拥抱 **Filament** 和 **Livewire**，为开发者和最终用户带来前所未有的流畅体验。

## ✨ 技术栈

-   **核心框架**: [Laravel 12](https://laravel.com)
-   **后台管理**: [Filament 3](https://filamentphp.com/)
-   **前端交互**: [Livewire 3](https://livewire.laravel.com/)
-   **UI 组件库**: [MaryUI](https://mary-ui.com/)
-   **CSS 框架**: [Tailwind CSS](https://tailwindcss.com/)
-   **数据库**: [PostgreSQL](https://www.postgresql.org/)

## 🚀 核心功能规划

-   **强大的后台管理**:
    -   [x] **仪表盘**: 核心数据统计（销售额、订单量）。
    -   [x] **商品管理**: 支持商品分类、多种商品规格。
    -   [x] **库存管理**: 强大的卡密或库存导入、导出、管理功能。
    -   [x] **订单管理**: 订单列表、详情、补单等。
    -   [x] **用户管理**: 查看和管理注册用户。
    -   [x] **系统设置**: 网站信息、支付配置、邮件模板配置。
-   **流畅的商城前端**:
    -   [x] **商品展示**: 简洁的商品列表和详情页。
    -   [x] **动态搜索**: 实时搜索和分类筛选。
    -   [x] **自助下单**: 流程简单，支持优惠券。
    -   [x] **订单查询**: 用户可通过联系方式或订单号查询订单。
-   **灵活的支付系统**:
    -   [x] 支持多种支付网关（计划集成 支付宝、微信支付等）。
    -   [x] 异步回调处理，保证订单状态实时更新。

## 🛠️ 开发路线图

### 第一阶段: 项目搭建与后台核心

1.  **项目初始化**:
    -   [ ] 创建 Laravel 12 项目。
    -   [ ] 安装并配置 Livewire, Filament, MaryUI。
    -   [ ] 配置 PostgreSQL 数据库连接。
2.  **数据库设计**:
    -   [ ] 创建核心数据表迁移 (`categories`, `products`, `inventories`, `orders`, `coupons`)。
    -   [ ] 定义 Eloquent 模型及表关联。
3.  **Filament 后台构建**:
    -   [ ] 为所有核心模型创建 Filament Resources (`ProductResource`, `OrderResource` 等)。
    -   [ ] 配置资源中的表单（Forms）和表格（Tables）。
    -   [ ] 实现后台的核心 CRUD 功能。

### 第二阶段: 前端商城与业务逻辑

1.  **Livewire 前端组件开发**:
    -   [ ] 创建 `HomePage` 组件用于商品展示。
    -   [ ] 创建 `ProductDetail` 组件用于商品详情。
    -   [ ] 创建 `OrderSearch` 组件用于订单查询。
2.  **核心业务逻辑实现**:
    -   [ ] **订单创建服务**: `OrderCreationService`，处理下单逻辑。
    -   [ ] **支付集成服务**: `PaymentGatewayService`，处理与第三方支付的交互。
    -   [ ] **自动发货逻辑**: 订单支付成功后，自动从库存中提取卡密并通过邮件发送。

### 第三阶段: 完善与部署

1.  **功能完善**:
    -   [ ] 邮件通知模板。
    -   [ ] 系统设置功能。
    -   [ ] 前端 UI/UX 优化。
2.  **测试**:
    -   [ ] 编写单元测试和功能测试。
    -   [ ] 全流程测试。
3.  **部署**:
    -   [ ] 编写部署文档。
    -   [ ] 配置生产环境（如 Nginx, Supervisor）。

## 🚀 快速开始

```bash
# 1. 克隆项目
git clone https://github.com/your-username/pxiuka.git
cd pxiuka

# 2. 安装 Composer 依赖
composer install

# 3. 创建 .env 文件
cp .env.example .env

# 4. 生成应用密钥
php artisan key:generate

# 5. 配置数据库信息 (PostgreSQL)
# DB_CONNECTION=pgsql
# DB_HOST=127.0.0.1
# ...

# 6. 运行数据库迁移
php artisan migrate --seed

# 7. 创建后台管理员账户
php artisan make:filament-user

# 8. 编译前端资源
npm install
npm run dev

# 9. 启动开发服务器
php artisan serve
```

---
**貔貅发卡 (pxiuka)** - 为现代化的虚拟商品交易而生。
